<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use App\Entity\Team as Entity;

final class Players extends EntityRepository {

    public function findByTeam($teamId) {
        return $this->findBy(['team_id' => $teamId]);
    }

}