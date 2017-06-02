<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

final class GameStats extends EntityRepository {

    /**
     * @param $gameId
     * @return \App\Entity\GameStats[]
     */
    public function findByGame($gameId) {
        return $this->findBy(['game' => $gameId]);
    }

    public function getPlayerRanking($leagueId, $field) {
        $validFields = ['goals', 'yellowCard', 'redCard', 'score'];

        if (!in_array($field, $validFields)) {
            throw new \InvalidArgumentException('Invalid field '.$field);
        }

        $query = $this->createQueryBuilder('gs')
                        ->select('SUM(gs.'.$field.') as total, p.id as playerId, p.name as playerName, t.id as teamId, t.name as teamName')
                        ->join('gs.game', 'g', Join::WITH)
                        ->join('gs.team', 't', Join::WITH)
                        ->join('gs.player', 'p', Join::WITH)
                        ->groupBy('gs.'.$field.', p.id, p.name, t.id, t.name')
                        ->orderBy('total', 'DESC')
                        ->having('total > 0')
                        ->where('g.league= :leagueId');

        $query->setParameters(['leagueId' => $leagueId]);

        return $query->getQuery()->getResult();
    }

    public function deleteFromGame($gameId) {
        $query = $this->getEntityManager()->createQuery('DELETE '.\App\Entity\GameStats::class.' f WHERE f.game = :gameId');
        return $query->execute(['gameId' => $gameId]);
    }

}