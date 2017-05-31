<?php

namespace App\Twig;

use Doctrine\ORM\EntityManager;
use Twig_Extension;
use Twig_Function;


class RepositoryExtension extends Twig_Extension
{

    private $entityManager;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function getFunctions()
    {
        return array(
            new Twig_Function('repository', [$this, 'getRepository']),
        );
    }

    public function getRepository($name) {
        $className = '\App\Entity\\'.$name;
        return $this->entityManager->getRepository($className);
    }
}