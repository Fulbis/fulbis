<?php

namespace App\Hydrator;

use Interop\Container\ContainerInterface;
use Zend\Hydrator\ClassMethods;
use Zend\ServiceManager\Factory\FactoryInterface;

class Factory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $hydrator = new ClassMethods;

        $hydrator->addStrategy('user', $container->get(UserStrategy::class));
        $hydrator->addStrategy('league', $container->get(LeagueStrategy::class));
        $hydrator->addStrategy('game', $container->get(GameStrategy::class));
        $hydrator->addStrategy('player', $container->get(PlayerStrategy::class));
        $hydrator->addStrategy('team', $container->get(TeamStrategy::class));
        $hydrator->addStrategy('team1', $container->get(TeamStrategy::class));
        $hydrator->addStrategy('team2', $container->get(TeamStrategy::class));
        $hydrator->addStrategy('score1', $container->get(ScoreStrategy::class));
        $hydrator->addStrategy('score2', $container->get(ScoreStrategy::class));

        return $hydrator;
    }
}