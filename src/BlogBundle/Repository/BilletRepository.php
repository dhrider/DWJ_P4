<?php

// src/BlogBundle/Repository/BilletRepository.php

namespace BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;


/**
 * BilletRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BilletRepository extends EntityRepository
{
    // function récupérant tous les billets pour la pagination
    public function paginationBillet()
    {
        $qb = $this->createQueryBuilder('p');

        $qb
            ->select('p')
            ->orderBy('p.id', 'DESC') // triés par id décroissant
        ;

        return $qb; // on return direction la query et non le résultat (nécessaire pour le controlleur)
    }

    // function pour trouver les 5 derniers billets
    public function findFiveLastTitle()
    {
        $qb = $this->createQueryBuilder('t');

        $qb
            ->select('t')
            ->orderBy('t.id', 'DESC') // triés par id décroissant
            ->setMaxResults(5) // limité à 5 résultats
        ;

        return $qb
            ->getQuery()
            ->getResult()
        ;
    }
}

