<?php

namespace Auth\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouteResult;

class AuthAction implements ServerMiddlewareInterface
{
    private $auth;

    public function __construct(AuthenticationService $auth)
    {
        $this->auth = $auth;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        if (! $this->auth->hasIdentity()) {

            if($request->getUri()->getPath() === '/login' || $request->getUri()->getPath() === '/registro') {
                return $delegate->process($request);
            }

            return new RedirectResponse('/login');
        }

        if(in_array($request->getUri()->getPath(), ['/', '/login', '/registro'])) {
            return new RedirectResponse('/leagues');
        }

        $identity = $this->auth->getIdentity();
        return $delegate->process($request->withAttribute(self::class, $identity));
    }
}