<?php

namespace Tests\App\Service;

use App\Provider\GoogleClientCreator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class GoogleClientCreatorTest
 * @package Tests\App\Service
 */
class GoogleClientCreatorTest extends WebTestCase
{
    public function testIsReturnGoogleClientObject()
    {
        $googleClientCreator = $this->createMock(GoogleClientCreator::class);
        $googleClientCreator
            ->expects($this->any())
            ->method('create')
            ->willReturn(new \Google_Client())
        ;

        self::assertInstanceOf(\Google_Client::class, $googleClientCreator->create());
    }
}
