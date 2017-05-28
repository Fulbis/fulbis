<?php

namespace App\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;

class HomeAction implements ServerMiddlewareInterface
{

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        return new RedirectResponse('/login');
    }

}