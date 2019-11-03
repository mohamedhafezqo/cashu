<?php
/**
 * Created by PhpStorm.
 * User: hafez
 * Date: 02/11/19
 * Time: 10:33
 */

namespace App\Listener;

use App\Exceptions\RedirectException;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class RedirectExceptionListener
{
    /**
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        if ($event->getException() instanceof RedirectException) {
            $event->setResponse($event->getException()->getRedirectResponse());
        }
    }
}
