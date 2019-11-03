<?php

namespace Tests\Exceptions;

use App\Exceptions\RedirectException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class ReditectExceptionTest
 * @package Tests\Exceptions
 */
class RedirectExceptionTest extends TestCase
{

    public function testIsReturnRedirectResponseObject()
    {
        $redirectException = new RedirectException(new RedirectResponse('/'));

        $expectedCriteria = $redirectException->getRedirectResponse();

        self::assertInstanceOf(RedirectResponse::class, $expectedCriteria);
    }
}
