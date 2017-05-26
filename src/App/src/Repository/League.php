<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use App\Entity\League as Entity;

final class League extends EntityRepository {

    public function findByUser($userId): array {
        return $this->findBy(['user' => $userId]);
    }

}