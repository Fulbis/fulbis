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

        return $hydrator;
    }
}