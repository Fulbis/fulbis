<?php

namespace Standings\Service;

final class StandingsOrder {

    public function sort(array $standings): array {

        // sort
        usort($standings, [$this, 'sortStandings']);

        return $standings;
    }

    private function sortStandings(array $a, array $b) {

        if ($a['pts'] != $b['pts']) {
            return $a['pts'] < $b['pts'];
        }

        if ($a['w'] != $b['w']) {
            return $a['w'] < $b['w'];
        }

        if ($a['d'] != $b['d']) {
            return $a['d'] < $b['d'];
        }

        if ($a['l'] != $b['l']) {
            return $a['l'] > $b['l'];
        }

        if ($a['gd'] != $b['gd']) {
            return $a['gd'] < $b['gd'];
        }

        if ($a['gf'] != $b['gf']) {
            return $a['gf'] < $b['gf'];
        }

        return $a['a'] > $b['a'];
    }

}