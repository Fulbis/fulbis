<?php

namespace Leagues\Action;

use App\Action\HelperTrait;
use App\Repository\GameStats;
use App\Repository\League;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Standings\Service\StandingsGenerator;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class DashboardAction implements ServerMiddlewareInterface
{

    use HelperTrait;

    private $template;
    private $standingsGenerator;
    private $gameStats;

    public function __construct(
        TemplateRendererInterface $template, StandingsGenerator $standingsGenerator, GameStats $gameStats
    ) {
        $this->template    = $template;
        $this->standingsGenerator = $standingsGenerator;
        $this->gameStats = $gameStats;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $leagueId = $this->getRouteParam($request,'leagueId');

        $standings = $this->standingsGenerator->getStandings($leagueId);
        $topScorers = $this->gameStats->getPlayerRanking($leagueId, 'goals');
        $bestPlayers = $this->gameStats->getPlayerRanking($leagueId, 'score');

        return new HtmlResponse($this->template->render('leagues::dashboard', ['standings' => $standings, 'topScorers' => $topScorers, 'bestPlayers' => $bestPlayers]));
    }


}