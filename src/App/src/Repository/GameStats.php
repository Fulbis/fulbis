<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

final class GameStats extends EntityRepository {

    /**
     * @param $gameId
     * @return \App\Entity\GameStats[]
     */
    public function findByGame($gameId) {
        return $this->findBy(['game' => $gameId]);
    }

    public function deleteFromGame($gameId) {
        $query = $this->getEntityManager()->createQuery('DELETE '.\App\Entity\GameStats::class.' f WHERE f.game = :gameId');
        return $query->execute(['gameId' => $gameId]);
    }

}