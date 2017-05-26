<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\User")
 * @ORM\Table(name="users")
 */
class User
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
     * @var string
     *
     * @ORM\Column(type="string", name="email", length=40, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="password", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="nombre", length=50)
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
     * @return User
     */
    public function setId(\Ramsey\Uuid\Uuid $id): User
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
     * @return User
     */
    public function setCreatedAt(\DateTime $created_at): User
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
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
     * @return User
     */
    public function setName(string $name): User
    {
        $this->name = $name;
        return $this;
    }

    public function getArrayCopy() {
        return [
            'id' => (string)$this->getId(),
            'email' => $this->getEmail(),
            'name' => $this->getName(),
        ];
    }
}