<?php

namespace App\Repository;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\AbstractFactoryInterface;

class AbstractFactory implements AbstractFactoryInterface
{
    public function canCreate(ContainerInterface $container, $requestedName)
    {
        return substr($requestedName, 0, 15) == 'App\\Repository\\';
    }

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entity = explode('\\', $requestedName);
        $entity = end($entity);

        $em = $container->get(\Doctrine\ORM\EntityManager::class);

        $repository = $em->getRepository('App\Entity\\'.$entity);

        return $repository;
    }
}