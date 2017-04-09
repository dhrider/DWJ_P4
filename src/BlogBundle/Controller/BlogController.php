<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Billet;
use BlogBundle\Form\BilletType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BlogBundle\Form\CommentType;
use BlogBundle\Entity\Comment;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;


class BlogController extends Controller
{
    /**
     * @param $page
     * @Route("/", name="blog_homepage", defaults={"page" = 1})
     * @Route("/{page}", name="blog_homepage_paginated")
     * @Template()
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($page)
    {
        $em = $this->getDoctrine()->getEntityManager();

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
        $billetsAside = $this->getRepo('Billet')->findFiveLastTitle();

        $commentAside = $this->getRepo('Comment')->findFiveLastComments();

        return $this->render('BlogBundle::aside.html.twig', array(
            'billetAside' => $billetsAside,
            'commentAside' => $commentAside
        ));
    }

    public function billetAction(Request $request)
    {
        $billet = $this->getRepo('Billet')->find($request->get('id'));

        $comments = $this->getRepo('Comment')->findCommentsByBilletId($billet->getId());

        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $comment->setBillet($billet);

            $em  = $this->getDoctrine()->getManager();
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

    public function billetsAdminAction()
    {
        $billets = $this->getRepo('Billet')->findBillets();

        return $this->render('BlogBundle:Billets:billetsAdmin.html.twig', array(
            'billets' => $billets
        ));
    }

    public function deleteBilletAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $billet = $em->getRepository('BlogBundle:Billet')->find($request->get('id'));

        $em->remove($billet);
        $em->flush();

        return $this->redirectToRoute('blog_billetsAdmin');
    }

    public function editBilletAction(Request $request)
    {
        $billet = $this->getRepo('Billet')->find($request->get('id'));

        $form = $this->createForm(BilletType::class, $billet);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $billet->setDateUpdate(new \DateTime());
            $billet->setTitle($form->getData()->getTitle());
            $billet->setContent($form->getData()->getContent());

            $em  = $this->getDoctrine()->getManager();
            $em->persist($billet);
            $em->flush();

            return $this->redirectToRoute('blog_billetsAdmin');
        }

        return $this->render('BlogBundle:Billets:editBilletAdmin.html.twig', array(
            'billet' => $billet,
            'form' => $form->createView()
        ));
    }

    public function addBilletAction(Request $request)
    {
        $billet = new Billet();

        $form = $this->createForm(BilletType::class, $billet);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em  = $this->getDoctrine()->getManager();
            $em->persist($billet);
            $em->flush();

            return $this->redirectToRoute('blog_billetsAdmin');
        }

        return $this->render('BlogBundle:Billets:addBilletAdmin.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function commentsAdminAction()
    {
        $comments = $this->getRepo('Comment')->findAllComments();

        return $this->render('BlogBundle:Comments:commentsAdmin.html.twig', array(
            'comments' => $comments
        ));
    }

    public function commentsByBilletAdminAction(Request $request)
    {
        $comments = $this->getRepo('Comment')->findCommentsByBilletId($request->get('id'));
        $billet = $this->getRepo('Billet')->find($request->get('id'));

        return $this->render('BlogBundle:Comments:commentsByBilletAdmin.html.twig', array(
            'comments' => $comments,
            'billet' => $billet
        ));
    }

    public function deleteCommentAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $comment =$em->getRepository('BlogBundle:Comment')->find($request->get('id'));

        $em->remove($comment);
        $em->flush();

        return $this->redirectToRoute('blog_commentsAdmin');
    }

    public function getRepo($repository)
    {
        $result = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BlogBundle:'.$repository)
        ;

        return $result;
    }
}
