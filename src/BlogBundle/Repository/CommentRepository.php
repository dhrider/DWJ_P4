<?php

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
    public function findCommentsByBilletId($id)
    {
        $qb = $this->createQueryBuilder('c');

        $qb
            ->select('c')
            ->where('c.billet = :id')
            ->setParameter('id', $id)
        ;

        return $qb->getQuery()->getResult();
    }

    public function findCommentsByAuthor($author)
    {
        $qb = $this->createQueryBuilder('c');

        $qb
            ->select('c')
            ->where('c.author = :author')
            ->setParameter('author',$author)
        ;

        return $qb->getQuery()->getResult();
    }

    public function findCommentsSignaled()
    {
        $qb = $this->createQueryBuilder('c');

        $qb
            ->select('c')
            ->where('c.signaled = :signaled')
            ->setParameter('signaled', true)
        ;

        return $qb->getQuery()->getResult();
    }

    public function findFiveLastComments()
    {
        $qb = $this->createQueryBuilder('c');

        $qb
            ->select('c')
            ->leftJoin('c.billet', 'billet')
            ->addSelect('billet')
            ->orderBy('c.date', 'DESC')
            ->setMaxResults(5)
        ;

        return $qb->getQuery()->getResult();
    }

    public function findAllComments()
    {
        $qb = $this->createQueryBuilder('c');

        $qb
            ->select('c')
            ->leftJoin('c.billet', 'billet')
            ->addSelect('billet')
            ->orderBy('c.date', 'DESC')
        ;

        return $qb->getQuery()->getResult();
    }

}

