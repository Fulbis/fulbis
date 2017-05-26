<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;
use Zend\Hydrator\ClassMethods;

final class EntityPersister {

    private $hydrator;
    private $entityManager;

    public function __construct(ClassMethods $hydrator, EntityManager $entityManager) {
        $this->hydrator = $hydrator;
        $this->entityManager = $entityManager;
    }

    public function create($entityClassName, array $data) {
        $entity = new $entityClassName;

        $this->hydrator->hydrate($data, $entity);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

    public function edit($entityClassName, $id, array $data) {
        $entity = $this->entityManager->getRepository($entityClassName)->find($id);

        $this->hydrator->hydrate($data, $entity);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

    public function delete($entityClassName, $id) {
        $entity = $this->entityManager->getRepository($entityClassName)->find($id);

        $this->entityManager->remove($entity);
        $this->entityManager->flush();

        return true;
    }

}