<?php

namespace App\Hydrator;

use Zend\Hydrator\Strategy\StrategyInterface;

class ScoreStrategy implements StrategyInterface
{

    public function extract($value)
    {
        return $value;
    }

    public function hydrate($value)
    {
        return $value === "" ? null : $value;
    }
}