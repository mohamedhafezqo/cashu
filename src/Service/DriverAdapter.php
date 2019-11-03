<?php

namespace App\Service;

use App\Contract\DriverAdapterInterface;
use App\Contract\ProviderInterface;

/**
 * Class DriverAdapter
 * @package App\Service
 */
class DriverAdapter implements DriverAdapterInterface
{
    /**
     * @var ProviderInterface $provider
     */
    private $provider;

    /**
     * DriverAdapter constructor.
     * @param ProviderInterface $driver
     */
    public function __construct(ProviderInterface $driver)
    {
        $this->setProvider($driver);
    }

    /**
     * @param ProviderInterface $provider
     * @return DriverAdapterInterface
     */
    public function setProvider(ProviderInterface $provider): DriverAdapterInterface
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * @param array $query
     * @return array
     */
    public function listFiles(array $query = []): array
    {
        return $this->provider->listFiles($query);
    }
}
