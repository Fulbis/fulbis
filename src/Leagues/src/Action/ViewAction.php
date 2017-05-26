<?php

namespace Leagues\Action;

use App\Repository\League;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class ViewAction implements ServerMiddlewareInterface
{
    private $template;

    public function __construct(
        TemplateRendererInterface $template
    ) {
        $this->template    = $template;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        return new HtmlResponse($this->template->render('leagues::view'));
    }


}