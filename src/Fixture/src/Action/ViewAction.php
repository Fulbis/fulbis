<?php

namespace Fixture\Action;

use App\Action\HelperTrait;
use App\Repository\Fixture;
use App\Repository\League;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class ViewAction implements ServerMiddlewareInterface
{
    use HelperTrait;

    private $template;
    private $fixture;

    public function __construct(
        TemplateRendererInterface $template, Fixture $fixture
    ) {
        $this->template = $template;
        $this->fixture = $fixture;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $params = ['matches' => $this->fixture->findByLeague($this->getRouteParam($request,'leagueId'))];
        return new HtmlResponse($this->template->render('fixture::view', $params));
    }


}