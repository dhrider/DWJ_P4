<?php
// src/BlogBundle/Controller/BlogController.php

namespace BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
    public function indexAction($page = 1) // page principale : on définit le numéro de la page à 1 par défaut
    {
        $em = $this->getDoctrine()->getManager();

        // gestion de la pagination
        $adapter = new DoctrineORMAdapter($em->getRepository('BlogBundle:Billet')->paginationBillet());
        $pager = new Pagerfanta($adapter);
        $pager->setMaxPerPage(5);
        $pager->setCurrentPage($page);

        return $this->render('BlogBundle::index.html.twig', array(
            'pager' => $pager
        ));
    }

    // gestion du menu de droite
    public function asideAction()
    {
        $em = $this->getDoctrine()->getManager();

        // on récupère les 5 derniers billets
        $billetsAside = $em->getRepository('BlogBundle:Billet')->findFiveLastTitle();

        // on récupère les 5 derniers commentaires
        $commentAside = $em->getRepository('BlogBundle:Comment')->findFiveLastComments();

        return $this->render('BlogBundle::aside.html.twig', array(
            'billetAside' => $billetsAside,
            'commentAside' => $commentAside
        ));
    }

    // page d'un billet
    public function billetAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        // on récupère le billet en fonction de son is
        $billet = $em->getRepository('BlogBundle:Billet')->find($request->get('id'));

        // on récupère tous les commentaires associés à ce billet
        $comments = $em->getRepository('BlogBundle:Comment')->findCommentsByBilletId($billet->getId());

        if (null === $billet)
        {
            throw new NotFoundHttpException("Le billet d'id ".$request->get('id')." n'existe pas.");
        }

        // on crée un nouveau commentaire (en attente)
        $comment = new Comment();
        // et le formulaire d'un commentaire
        $form = $this->createForm(CommentType::class, $comment);

        // si le méthode est 'POST' et que le formulaire est valide
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            // on associe le billet en cours au nouveau commentaire
            $comment->setBillet($billet);

            $em->persist($comment);
            $em->flush();

            // on redirige vers la page du billet en générant une adresse complété de l'id du billet et d'une ancre
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

    // action (non affichée) gérant le signalement d'un commentaire
    public function commentSignaledAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        // on récupère le commentaire concerné grâce à son id
        $comment = $em->getRepository('BlogBundle:Comment')->find($request->get('id'));

        $comment->setSignaled(true); // on set son signalement à true
        $comment->setDateSignaled(new \DateTime()); // on donne la date de l'instant pour le signalement

        $em->persist($comment);
        $em->flush();

        return $this->redirect($this->generateUrl('blog_billet',
            ['id' => $comment->getBillet()->getId()]).'#comments')
        ;
    }
}

