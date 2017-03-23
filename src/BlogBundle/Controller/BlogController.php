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
}
