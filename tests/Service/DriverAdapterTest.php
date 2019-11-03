<?php

namespace Tests\Service;

use App\Service\DriverAdapter;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class DriverAdapterTest
 * @package Tests\Service
 */
class DriverAdapterTest extends WebTestCase
{
    public function testListFilesIsReturnArray()
    {
        $driverAdapter = $this->createMock(DriverAdapter::class);
        $driverAdapter
            ->expects($this->any())
            ->method('listFiles')
            ->willReturn([])
        ;

        self::assertIsArray($driverAdapter->listFiles());
    }
}
