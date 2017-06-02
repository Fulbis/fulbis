<?php

namespace Fixture\Action;

use App\Action\HelperTrait;
use App\Repository\Game;
use App\Repository\League;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class GameAction implements ServerMiddlewareInterface
{
    use HelperTrait;

    private $template;
    private $game;

    public function __construct(
        TemplateRendererInterface $template, Game $game
    ) {
        $this->template = $template;
        $this->game = $game;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $params = ['game' => $this->game->find($this->getRouteParam($request,'gameId'))];
        return new HtmlResponse($this->template->render('fixture::game', $params));
    }


}