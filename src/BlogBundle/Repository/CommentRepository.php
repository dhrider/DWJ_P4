<?php
// src/BlogBundle/Repository/CommentRepository.php

namespace BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * CommentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentRepository extends EntityRepository
{
    // fonction pour trouver tous les commentaires en fonction de l'id d'un billet
    public function findCommentsByBilletId($id)
    {
        $qb = $this->createQueryBuilder('c');

        $qb
            ->select('c')
            ->where('c.billet = :id') // condition = id du billet
            ->setParameter('id', $id)
            ->orderBy('c.id', 'ASC')
        ;

        return $qb->getQuery()->getResult();
    }

    // fonction pour trouver tous les commentaires en fonction d'un auteur
    public function findCommentsByAuthor($author)
    {
        $qb = $this->createQueryBuilder('c');

        $qb
            ->select('c')
            ->where('c.author = :author') // condition = nom de l'auteur
            ->setParameter('author',$author)
        ;

        return $qb->getQuery()->getResult();
    }

    // fonction pour trouver tous les commentaires signalés
    public function findCommentsSignaled()
    {
        $qb = $this->createQueryBuilder('c');

        $qb
            ->select('c')
            ->where('c.signaled = :signaled') // condition = signaled à true
            ->setParameter('signaled', true)
        ;

        return $qb->getQuery()->getResult();
    }

    // fonction pour trouver  les 5 derniers commentaires
    public function findFiveLastComments()
    {
        $qb = $this->createQueryBuilder('c');

        $qb
            ->select('c')
            ->leftJoin('c.billet', 'billet') // on fait une jointure avec la table billet
            ->addSelect('billet') // on ajoute les billets au select
            ->orderBy('c.date', 'DESC') // triés par date de création décroissant
            ->setMaxResults(5) // limité à 5 résultats
        ;

        return $qb->getQuery()->getResult();
    }

    // fonction pour trouver tous les commentaires
    public function findAllComments()
    {
        $qb = $this->createQueryBuilder('c');

        $qb
            ->select('c')
            ->leftJoin('c.billet', 'billet') // on fait une jointure avec la table billet
            ->addSelect('billet') // on ajoute les billets au select
            ->orderBy('c.date', 'DESC') // triés par date de création décroissant
        ;

        return $qb->getQuery()->getResult();
    }

}

