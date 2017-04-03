<?php

namespace BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BlogBundle\Form\CommentType;
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
        $billetsAside = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BlogBundle:Billet')
            ->findFiveLastTitle()
        ;

        return $this->render('BlogBundle::aside.html.twig', array(
            'aside' => $billetsAside
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

        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $comment->setBillet($billet);

            $em  = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('blog_billet', array(
                'id' => $billet->getId()
            ));
        }

        return $this->render('BlogBundle:Billets:billet.html.twig', array(
            'billet' => $billet,
            'comments' => $comments,
            'form' => $form->createView()
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
