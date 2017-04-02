<?php

namespace BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BlogBundle\Entity\Billet;
use BlogBundle\Entity\Comment;


class BlogController extends Controller
{
    public function indexAction()
    {
        $billets = $this->getAllBillets();

        return $this->render('BlogBundle::index.html.twig', array(
            'billets' => $billets
        ));
    }

    public function asideAction()
    {
        $billetsCommentsAside = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BlogBundle:Billet')
            ->findFiveLastTitle()
        ;

        return $this->render('BlogBundle::aside.html.twig', array(
            'aside' => $billetsCommentsAside
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

        $comments = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BlogBundle:Comment')
            ->findCommentsByBilletId($billet->getId())
        ;

        return $this->render('BlogBundle:Billets:billet.html.twig', array(
            'billet' => $billet,
            'comments' => $comments
        ));
    }


    public function billetsAdminAction()
    {
        $billets = $this->getAllBillets();

        return $this->render('BlogBundle:Billets:billetsAdmin.html.twig', array(
            'billets' => $billets
        ));
    }

    public function commentsAdminAction()
    {
        $comments = $this->getAllComments();

        return $this->render('BlogBundle:Comments:commentsAdmin.html.twig', array(
            'comments' => $comments
        ));
    }

    public function getAllBillets()
    {
        $result = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BlogBundle:Billet')
            ->findBillets()
        ;

        return $result;
    }

    public function getAllComments()
    {
        $result = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BlogBundle:Comment')
            ->findAll()
        ;

        return $result;
    }
}
