<?php

namespace Standings\Action;

use App\Action\HelperTrait;;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Standings\Service\StandingsGenerator;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class ViewAction implements ServerMiddlewareInterface
{
    use HelperTrait;

    private $template;
    private $standingsGenerator;

    public function __construct(
        TemplateRendererInterface $template, StandingsGenerator $standingsGenerator
    ) {
        $this->template = $template;
        $this->standingsGenerator = $standingsGenerator;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $standings = $this->standingsGenerator->getStandings($this->getRouteParam($request,'leagueId'));

        return new HtmlResponse($this->template->render('standings::view', ['standings' => $standings]));
    }


}