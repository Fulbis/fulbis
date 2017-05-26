<?php

namespace Auth\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class LogoutAction implements ServerMiddlewareInterface
{
    private $auth;
    private $template;

    public function __construct(
        TemplateRendererInterface $template,
        AuthenticationService $auth
    ) {
        $this->template    = $template;
        $this->auth        = $auth;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $this->auth->clearIdentity();

        return new RedirectResponse('/');
    }

}