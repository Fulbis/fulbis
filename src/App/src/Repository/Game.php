<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

final class Game extends EntityRepository {

    /**
     * @param $leagueId
     * @param int $round
     * @return \App\Entity\Game[]
     */
    public function findByLeague($leagueId, int $round = 0) {
        $criteria = ['league' => $leagueId];

        if ($round) {
            $criteria['round'] = $round;
        }

        return $this->findBy($criteria, ['round' => 'ASC']);
    }

    public function deleteFromLeague($leagueId) {
        $query = $this->getEntityManager()->createQuery('DELETE '.\App\Entity\Game::class.' f WHERE f.league = :leagueId');
        return $query->execute(['leagueId' => $leagueId]);
    }

}