<?php

namespace App\Provider;

use App\Contract\ClientCreatorInterface;
use App\Exceptions\RedirectException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class GoogleClientCreator
 * @package App\Provider
 */
class GoogleClientCreator implements ClientCreatorInterface
{
    /**
     * @var array $config
     */
    private $config;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var RouterInterface $router
     */
    private $router;

    /**
     * @var \Google_Client $client
     */
    private $client;

    /**
     * @var RequestStack $request
     */
    private $request;

    /**
     * AuthenticationService constructor.
     *
     * @param array $config
     * @param SessionInterface $session
     * @param RouterInterface $router
     * @param RequestStack $request
     */
    public function __construct(
        array $config,
        SessionInterface $session,
        RouterInterface $router,
        RequestStack $request
    )
    {
        $this->config = $config['google_drive'];
        $this->session = $session;
        $this->router = $router;
        $this->request = $request->getCurrentRequest();
    }

    /**
     * @return \Google_Client
     */
    public function create(): \Google_Client
    {
        $this->authenticate();

        return $this->client;
    }

    private function authenticate()
    {
        $this->initClient();

        if (!$this->getAccessToken()) {
            $this->generateAccessToken($this->request->get('code'));
        }
    }

    /**
     * @return \Google_Client
     */
    protected function initClient()
    {
        $this->client = new \Google_Client();
        $this->client->setApplicationName(GoogleDriver::APPLICATION_NAME);
        $this->client->setScopes([\Google_Service_Drive::DRIVE_READONLY]);
        $this->client->setAuthConfig($this->config);
        $this->client->setAccessType(GoogleDriver::ACCESS_TYPE);
        $this->client->setPrompt('select_account consent');

        return $this->client;
    }

    /**
     * @return array|null
     */
    private function getAccessToken(): ?array
    {
        $accessToken = $this->getCachedToken();

        if ($this->isAccessTokenExpired() and $this->getRefreshToken()) {
            $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
            $accessToken = $this->client->getAccessToken();
            $this->session->set('accessToken', $accessToken);
        }

        return $accessToken;
    }

    /**
     * @return null|string
     */
    private function getCachedToken()
    {
        if ($this->session->has('accessToken')) {
            $this->client->setAccessToken($this->session->get('accessToken'));
        }

        return $this->session->get('accessToken') ?? null;
    }

    /**
     * @param $code
     * @throws RedirectException
     */
    private function generateAccessToken($code)
    {
        if ($this->request->get('code', null)) {

            $this->client->authenticate($code);
            $this->session->set('accessToken', $this->client->getAccessToken());

            throw new RedirectException(new RedirectResponse($this->router->generate('driver_list')));
        }

        throw new RedirectException(new RedirectResponse($this->getAuthUrl()));
    }

    /**
     * @return string
     */
    private function getAuthUrl(): ?string
    {
        return $this->client->createAuthUrl();
    }

    /**
     * @return bool
     */
    private function isAccessTokenExpired(): bool
    {
        return $this->client->isAccessTokenExpired();
    }

    /**
     * @return null|string
     */
    private function getRefreshToken(): ?string
    {
        return $this->client->getRefreshToken();
    }
}
