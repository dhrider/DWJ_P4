<?php

namespace BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BlogBundle\Form\Type\CommentType;
use BlogBundle\Entity\Comment;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;


class BlogController extends Controller
{
    /**
     * @param $page
     * @Route("/{page}", name="blog_homepage_paginated", defaults={"page" = 1})
     * @Template()
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($page = 1)
    {
        $em = $this->getDoctrine()->getManager();

        $adapter = new DoctrineORMAdapter($em->getRepository('BlogBundle:Billet')->paginationBillet());
        $pager = new Pagerfanta($adapter);

        $pager->setMaxPerPage(5);
        $pager->setCurrentPage($page);

        return $this->render('BlogBundle::index.html.twig', array(
            'pager' => $pager
        ));
    }

    public function asideAction()
    {
        $em = $this->getDoctrine()->getManager();

        $billetsAside = $em->getRepository('BlogBundle:Billet')->findFiveLastTitle();
        $commentAside = $em->getRepository('BlogBundle:Comment')->findFiveLastComments();

        return $this->render('BlogBundle::aside.html.twig', array(
            'billetAside' => $billetsAside,
            'commentAside' => $commentAside
        ));
    }

    public function billetAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $billet = $em->getRepository('BlogBundle:Billet')->find($request->get('id'));
        $comments = $em->getRepository('BlogBundle:Comment')->findCommentsByBilletId($billet->getId());

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $comment->setBillet($billet);

            $em->persist($comment);
            $em->flush();

            return $this->redirect($this->generateUrl('blog_billet',
                ['id' => $comment->getBillet()->getId()]).'#comments')
            ;
        }

        return $this->render('BlogBundle:Billets:billet.html.twig', array(
            'billet' => $billet,
            'comments' => $comments,
            'form' => $form->createView()
        ));
    }

    public function commentSignaledAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $comment = $em->getRepository('BlogBundle:Comment')->find($request->get('id'));

        $comment->setSignaled(true);
        $comment->setDateSignaled(new \DateTime());

        $em->persist($comment);
        $em->flush();

        return $this->redirect($this->generateUrl('blog_billet',
            ['id' => $comment->getBillet()->getId()]).'#comments')
        ;
    }
}

