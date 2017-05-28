<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

final class Fixture extends EntityRepository {

    public function findByLeague($leagueId) {
        return $this->findBy(['league' => $leagueId]);
    }

}