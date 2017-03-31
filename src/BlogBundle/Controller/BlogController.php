<?php

namespace BlogBundle\Controller;

use BlogBundle\Form\CommentType;
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

        return $this->render('BlogBundle::billetAside.html.twig', array(
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

        return $this->render('BlogBundle::billet.html.twig', array(
            'billet' => $billet,
            'comments' => $comments
        ));
    }

    public function addCommentAction(Request $request)
    {

        $comment = new Comment();
        $form = $this->get('form.factory')->create(CommentType::class, $comment);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            var_dump($comment);
            exit;
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
        }

        return $this->render('BlogBundle::addComment.html.twig', array(
           'form' => $form->createView()
        ));
    }

    public function adminBilletsAction()
    {
        $billets = $this->getAllBillets();

        return $this->render('BlogBundle::adminBillets.html.twig', array(
            'billets' => $billets
        ));
    }

    public function adminCommentsAction()
    {
        $comments = $this->getAllComments();

        return $this->render('BlogBundle::adminComments.html.twig', array(
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
