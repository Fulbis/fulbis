<?php

namespace App\Hydrator;

use Doctrine\ORM\EntityManager;
use Zend\Hydrator\Strategy\StrategyInterface;

class UserStrategy implements StrategyInterface
{
    private $entityManager;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function extract($value)
    {
        return $value;
    }

    public function hydrate($value)
    {
        return $this->entityManager->getReference(\App\Entity\User::class, $value);
    }
}