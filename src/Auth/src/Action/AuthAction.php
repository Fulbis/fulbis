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

    private $allowedPaths = ['/', '/login', '/logout', '/signup'];

    public function __construct(AuthenticationService $auth)
    {
        $this->auth = $auth;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        if (! $this->auth->hasIdentity()) {

            if(in_array($request->getUri()->getPath(), $this->allowedPaths)) {
                return $delegate->process($request);
            }

            return new RedirectResponse('/login');
        }

        if(in_array($request->getUri()->getPath(), $this->allowedPaths)) {
            return new RedirectResponse('/leagues');
        }

        $identity = $this->auth->getIdentity();
        return $delegate->process($request->withAttribute(self::class, $identity));
    }
}