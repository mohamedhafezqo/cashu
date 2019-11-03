<?php

namespace Tests\App\Service;

use App\Provider\GoogleDriver;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class GoogleDriverTest
 * @package Tests\App\Service
 */
class GoogleDriverTest extends WebTestCase
{
    public function testListFilesIsReturnArray()
    {
        $googleDriver = $this->createMock(GoogleDriver::class);
        $googleDriver
            ->expects($this->any())
            ->method('listFiles')
            ->willReturn([])
        ;

        self::assertIsArray($googleDriver->listFiles());
    }
}
