<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Game")
 * @ORM\Table(name="games")
 */
class Game
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
     * @var League
     *
     * @ORM\ManyToOne(targetEntity="league")
     * @ORM\JoinColumn(name="league_id", referencedColumnName="id")
     */
    private $league;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint", name="round")
     */
    private $round;

    /**
     * @var Team|null
     *
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="team1_id", referencedColumnName="id", nullable=true)
     */
    private $team1;

    /**
     * @var Team|null
     *
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="team2_id", referencedColumnName="id", nullable=true)
     */
    private $team2;

    /**
     * @var int|null
     *
     * @ORM\Column(type="smallint", name="score1", nullable=true)
     */
    private $score1;

    /**
     * @var int|null
     *
     * @ORM\Column(type="smallint", name="score2", nullable=true)
     */
    private $score2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="place", length=50)
     */
    private $place = '';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(type="time", name="time", nullable=true)
     */
    private $time;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(type="date", name="date", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="title", length=50)
     */
    private $title = '';

    /**
     * @var string
     *
     * @ORM\Column(type="text", name="comments")
     */
    private $comments = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="referee", length=50)
     */
    private $referee = '';

    /**
     * @return \Ramsey\Uuid\Uuid
     */
    public function getId(): \Ramsey\Uuid\Uuid
    {
        return $this->id;
    }

    /**
     * @param \Ramsey\Uuid\Uuid $id
     * @return Game
     */
    public function setId(\Ramsey\Uuid\Uuid $id): Game
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return League
     */
    public function getLeague(): League
    {
        return $this->league;
    }

    /**
     * @param League $league
     * @return Game
     */
    public function setLeague(League $league): Game
    {
        $this->league = $league;
        return $this;
    }

    /**
     * @return int
     */
    public function getRound(): int
    {
        return $this->round;
    }

    /**
     * @param int $round
     * @return Game
     */
    public function setRound(int $round): Game
    {
        $this->round = $round;
        return $this;
    }

    /**
     * @return Team|null
     */
    public function getTeam1(): ?Team
    {
        return $this->team1;
    }

    /**
     * @param Team|null $team1
     * @return Game
     */
    public function setTeam1(?Team $team1): Game
    {
        $this->team1 = $team1;
        return $this;
    }

    /**
     * @return Team|null
     */
    public function getTeam2(): ?Team
    {
        return $this->team2;
    }

    /**
     * @param Team|null $team2
     * @return Game
     */
    public function setTeam2(?Team $team2): Game
    {
        $this->team2 = $team2;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getScore1(): ?int
    {
        return $this->score1;
    }

    /**
     * @param int|null $score1
     * @return Game
     */
    public function setScore1(?int $score1): Game
    {
        $this->score1 = $score1;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getScore2(): ?int
    {
        return $this->score2;
    }

    /**
     * @param int|null $score2
     * @return Game
     */
    public function setScore2(?int $score2): Game
    {
        $this->score2 = $score2;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlace(): string
    {
        return $this->place;
    }

    /**
     * @param string $place
     * @return Game
     */
    public function setPlace(string $place): Game
    {
        $this->place = $place;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getTime(): ?\DateTime
    {
        return $this->time;
    }

    /**
     * @param \DateTime|null $time
     * @return Game
     */
    public function setTime(?\DateTime $time): Game
    {
        $this->time = $time;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime|null $date
     * @return Game
     */
    public function setDate(?\DateTime $date): Game
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Game
     */
    public function setTitle(string $title): Game
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getComments(): string
    {
        return $this->comments;
    }

    /**
     * @param string $comments
     * @return Game
     */
    public function setComments(string $comments): Game
    {
        $this->comments = $comments;
        return $this;
    }

    /**
     * @return string
     */
    public function getReferee(): string
    {
        return $this->referee;
    }

    /**
     * @param string $referee
     * @return Game
     */
    public function setReferee(string $referee): Game
    {
        $this->referee = $referee;
        return $this;
    }

    public function getArrayCopy() {
        $team1 = $this->getTeam1();
        $team2 = $this->getTeam2();

        return [
            'id' => (string)$this->getId(),
            'team1' => $team1 ? (string)$team1->getId() : null,
            'team2' => $team2 ? (string)$team2->getId() : null,
            'score1' => $this->getScore1(),
            'score2' => $this->getScore2(),
            'title' => $this->getTitle(),
            'comments' => $this->getComments(),
            'referee' => $this->getReferee(),
        ];
    }

}