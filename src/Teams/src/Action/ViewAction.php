<?php

namespace Teams\Action;

use App\Action\HelperTrait;
use App\Repository\Player;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class ViewAction implements ServerMiddlewareInterface
{
    use HelperTrait;

    private $template;
    private $players;

    public function __construct(
        TemplateRendererInterface $template, Player $players
    ) {
        $this->template    = $template;
        $this->players = $players;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $players = $this->players->findByTeam($this->getRouteParam($request, 'teamId'));
        return new HtmlResponse($this->template->render('teams::view', ['players' => $players]));
    }


}