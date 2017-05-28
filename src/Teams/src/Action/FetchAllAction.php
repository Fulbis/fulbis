<?php

namespace Teams\Action;

use App\Action\HelperTrait;
use App\Repository\Team;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class FetchAllAction implements ServerMiddlewareInterface
{

    use HelperTrait;

    private $template;
    private $team;

    public function __construct(
        TemplateRendererInterface $template,
        Team $team
    ) {
        $this->template    = $template;
        $this->team        = $team;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $teams = $this->team->findByLeague($this->getRouteParam($request, 'leagueId'));
        return new HtmlResponse($this->template->render('teams::fetchAll', ['teams' => $teams]));
    }


}