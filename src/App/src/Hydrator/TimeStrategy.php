<?php

namespace App\Hydrator;

use Doctrine\ORM\EntityManager;
use Zend\Hydrator\Strategy\StrategyInterface;

class TimeStrategy implements StrategyInterface
{

    public function extract($value)
    {
        return $value;
    }

    public function hydrate($value)
    {
        if ($value === null) {
            return $value;
        }

        return \DateTime::createFromFormat('H:i', $value);
    }
}