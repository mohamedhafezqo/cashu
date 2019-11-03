<?php

/**
 * Created by PhpStorm.
 * User: hafez
 * Date: 02/11/19
 * Time: 10:30
 */

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\RedirectResponse;

class RedirectException extends \Exception
{
    /**
     * @var RedirectResponse
     */
    private $redirectResponse;

    /**
     * RedirectException constructor.
     * @param RedirectResponse $response
     */
    public function __construct(RedirectResponse $response)
    {
        $this->redirectResponse = $response;
    }

    /**
     * @return RedirectResponse
     */
    public function getRedirectResponse(): RedirectResponse
    {
        return $this->redirectResponse;
    }
}
