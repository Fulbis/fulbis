<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

final class Fixture extends EntityRepository {

    public function findByLeague($leagueId) {
        return $this->findBy(['league' => $leagueId], ['round' => 'ASC']);
    }

    public function deleteFromLeague($leagueId) {
        $query = $this->getEntityManager()->createQuery('DELETE '.\App\Entity\Fixture::class.' f WHERE f.league = :leagueId');
        return $query->execute(['leagueId' => $leagueId]);
    }

}