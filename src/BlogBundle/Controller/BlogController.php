<?php

namespace BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BlogBundle\Entity\Billet;


class BlogController extends Controller
{
    public function indexAction()
    {
        $billets = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BlogBundle:Billet')
            ->findAll()
        ;

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

        $billets = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BlogBundle:Billet')
            ->findAll()
        ;

        return $this->render('BlogBundle::billet.html.twig', array(
            'billet' => $billet,
            'billets' => $billets
        ));
    }

    public function billetsAdminAction()
    {
        return $this->render('BlogBundle::billetsAdmin.html.twig');
    }

    public function commentsAdminAction()
    {
        return $this->render('BlogBundle::commentsAdmin.html.twig');
    }
}
