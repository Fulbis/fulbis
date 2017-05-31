<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameStats")
 * @ORM\Table(name="games_stats")
 */
class GameStats
{
    /**
     * @var \Ramsey\Uuid\Uuid
     *
     * @ORM\Id
     * @ORM\Column(type="uuid")
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @var Game
     *
     * @ORM\ManyToOne(targetEntity="Game")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id")
     */
    private $game;

    /**
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     * @var Team
     */
    private $team;

    /**
     * @var Player
     *
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     */
    private $player;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint", name="goals")
     */
    private $goals;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint", name="yellow_card")
     */
    private $yellowCard;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint", name="red_card")
     */
    private $redCard;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint", name="score")
     */
    private $score;

    /**
     * @return \Ramsey\Uuid\Uuid
     */
    public function getId(): \Ramsey\Uuid\Uuid
    {
        return $this->id;
    }

    /**
     * @param \Ramsey\Uuid\Uuid $id
     * @return GameStats
     */
    public function setId(\Ramsey\Uuid\Uuid $id): GameStats
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Game
     */
    public function getGame(): Game
    {
        return $this->game;
    }

    /**
     * @param Game $game
     * @return GameStats
     */
    public function setGame(Game $game): GameStats
    {
        $this->game = $game;
        return $this;
    }

    /**
     * @return Team
     */
    public function getTeam(): Team
    {
        return $this->team;
    }

    /**
     * @param Team $team
     * @return GameStats
     */
    public function setTeam(Team $team): GameStats
    {
        $this->team = $team;
        return $this;
    }

    /**
     * @return Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }

    /**
     * @param Player $player
     * @return GameStats
     */
    public function setPlayer(Player $player): GameStats
    {
        $this->player = $player;
        return $this;
    }

    /**
     * @return int
     */
    public function getGoals(): int
    {
        return $this->goals;
    }

    /**
     * @param int $goals
     * @return GameStats
     */
    public function setGoals(int $goals): GameStats
    {
        $this->goals = $goals;
        return $this;
    }

    /**
     * @return int
     */
    public function getYellowCard(): int
    {
        return $this->yellowCard;
    }

    /**
     * @param int $yellowCard
     * @return GameStats
     */
    public function setYellowCard(int $yellowCard): GameStats
    {
        $this->yellowCard = $yellowCard;
        return $this;
    }

    /**
     * @return int
     */
    public function getRedCard(): int
    {
        return $this->redCard;
    }

    /**
     * @param int $redCard
     * @return GameStats
     */
    public function setRedCard(int $redCard): GameStats
    {
        $this->redCard = $redCard;
        return $this;
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * @param int $score
     * @return GameStats
     */
    public function setScore(int $score): GameStats
    {
        $this->score = $score;
        return $this;
    }

    public function getArrayCopy() {
        return [
            'id' => (string)$this->getId(),
            'goals' => $this->getGoals(),
            'yellowCard' => $this->getYellowCard(),
            'redCard' => $this->getRedCard(),
            'score' => $this->getScore(),
        ];
    }
}