<?php

namespace Standings\Service;

use App\Repository\Game;
use App\Repository\Team;

final class StandingsGenerator {

    private $team;
    private $game;
    private $order;

    public function __construct(Team $team, Game $game, StandingsOrder $order) {
        $this->team = $team;
        $this->game = $game;
        $this->order = $order;
    }

    public function getStandings($leagueId) {
        $standings = $this->getTeamsStanding($leagueId);

        foreach($this->game->findByLeague($leagueId) as $game) {

            if ($game->isPlayed()) {

                $standings[(string)$game->getTeam1()->getId()]['pld'] += 1;
                $standings[(string)$game->getTeam2()->getId()]['pld'] += 1;

                $standings[(string)$game->getTeam1()->getId()]['gf'] += $game->getScore1();
                $standings[(string)$game->getTeam1()->getId()]['ga'] += $game->getScore2();
                $standings[(string)$game->getTeam1()->getId()]['gd'] += ($game->getScore1() - $game->getScore2());

                $standings[(string)$game->getTeam2()->getId()]['gf'] += $game->getScore2();
                $standings[(string)$game->getTeam2()->getId()]['ga'] += $game->getScore1();
                $standings[(string)$game->getTeam2()->getId()]['gd'] += ($game->getScore2() - $game->getScore1());

                if ($game->isDraw()) {

                    $standings[(string)$game->getTeam1()->getId()]['pts'] += 1;
                    $standings[(string)$game->getTeam1()->getId()]['d'] += 1;

                    $standings[(string)$game->getTeam2()->getId()]['pts'] += 1;
                    $standings[(string)$game->getTeam2()->getId()]['d'] += 1;

                } else if ($game->hasWonTeam1()) {

                    $standings[(string)$game->getTeam1()->getId()]['pts'] += 3;
                    $standings[(string)$game->getTeam1()->getId()]['w'] += 1;

                    $standings[(string)$game->getTeam2()->getId()]['l'] += 1;

                } else {

                    // team 2 won

                    $standings[(string)$game->getTeam2()->getId()]['pts'] += 3;
                    $standings[(string)$game->getTeam2()->getId()]['w'] += 1;

                    $standings[(string)$game->getTeam1()->getId()]['l'] += 1;
                }

            }

        }

        $standings = $this->order->sort($standings);

        return array_combine(range(1, sizeof($standings)), $standings);
    }

    private function getTeamsStanding($leagueId) {
        $teams = [];

        foreach($this->team->findByLeague($leagueId) as $team) {
            $teams[(string)$team->getId()] = ['team' => $team->getName(), 'pld' => 0, 'pts' => 0, 'w' => 0, 'd' => 0, 'l' => 0, 'gf' => 0, 'ga' => 0, 'gd' => 0];
        }

        return $teams;
    }

}