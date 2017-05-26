<?php

namespace Leagues\Action;

use App\Repository\League;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class FetchAllAction implements ServerMiddlewareInterface
{
    private $template;
    private $league;

    public function __construct(
        TemplateRendererInterface $template,
        League $league
    ) {
        $this->template    = $template;
        $this->league        = $league;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $leagues = $this->league->findByUser($request->getAttribute(\Auth\Action\AuthAction::class)['id']);
        return new HtmlResponse($this->template->render('leagues::fetchAll', ['leagues' => $leagues]));
    }


}