<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Team")
 * @ORM\Table(name="teams")
 */
class Team
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
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $created_at;

    /**
     * @var League
     *
     * @ORM\OneToOne(targetEntity="League")
     * @ORM\JoinColumn(name="league_id", referencedColumnName="id")
     */
    private $league;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="name", length=50)
     */
    private $name;

    public function __construct() {
        $this->setCreatedAt(new \DateTime());
    }

    /**
     * @return \Ramsey\Uuid\Uuid
     */
    public function getId(): \Ramsey\Uuid\Uuid
    {
        return $this->id;
    }

    /**
     * @param \Ramsey\Uuid\Uuid $id
     * @return Team
     */
    public function setId(\Ramsey\Uuid\Uuid $id): Team
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    /**
     * @param \DateTime $created_at
     * @return Team
     */
    public function setCreatedAt(\DateTime $created_at): Team
    {
        $this->created_at = $created_at;
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
     * @return Team
     */
    public function setLeague(League $league): Team
    {
        $this->league = $league;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Team
     */
    public function setName(string $name): Team
    {
        $this->name = $name;
        return $this;
    }
}