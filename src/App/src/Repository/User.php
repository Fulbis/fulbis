<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use App\Entity\User as Entity;

final class User extends EntityRepository {

    public function findOneByEmail($email): ?Entity {
        return $this->findOneBy(['email' => $email]);
    }

}