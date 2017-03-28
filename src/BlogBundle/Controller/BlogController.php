<?php

namespace BlogBundle\Controller;

use Doctrine\ORM\Repository\RepositoryFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BlogBundle\Entity\Billet;


class BlogController extends Controller
{
    public function indexAction()
    {
        $billets = $this->findAll('Billet');

        return $this->render('BlogBundle::index.html.twig', array(
            'billets' => $billets
        ));
    }

    public function billetAction(Request $request)
    {
        $billet = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BlogBundle:Billet')
            ->find($request->get('id'))
        ;

        $billets = $this->findAll('Billet');

        return $this->render('BlogBundle::billet.html.twig', array(
            'billet' => $billet,
            'billets' => $billets
        ));
    }

    public function adminBilletsAction()
    {
        $billets = $this->findAll('Billet');

        return $this->render('BlogBundle::adminBillets.html.twig', array(
            'billets' => $billets
        ));
    }

    public function adminCommentsAction()
    {
        $comments = $this->findAll('Comment');

        return $this->render('BlogBundle::adminComments.html.twig', array(
            'comments' => $comments
        ));
    }

    public function findAll($table)
    {
        $result = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BlogBundle:'.$table)
            ->findAll()
        ;

        return $result;
    }
}
