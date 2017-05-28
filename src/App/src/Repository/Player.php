<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use App\Entity\Team as Entity;

final class Player extends EntityRepository {

    public function findByTeam($teamId) {
        return $this->findBy(['team' => $teamId]);
    }

}