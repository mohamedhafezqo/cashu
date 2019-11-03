<?php

namespace Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DriverControllerTest
 * @package Tests\Controller
 */
class DriverControllerTest extends WebTestCase
{
    public function testListResponse()
    {
        $client = static::createClient();
        $client->request('GET', '/api/driver/list');

        $response = $client->getResponse();
        $this->assertHTTPFOUNDStatusCode($response);
    }

    /**
     * @param Response $response
     */
    public function assertHTTPFOUNDStatusCode(Response $response)
    {
        $this->assertEquals(
            Response::HTTP_FOUND,
            $response->getStatusCode(),
            $response->getContent()
        );
    }
}
