<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use App\Entity\Team as Entity;

final class Team extends EntityRepository {

    public function findByLeague($leagueId): array {
        return $this->findBy(['league' => $leagueId]);
    }

}