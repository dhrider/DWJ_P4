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
        $billets = $this->getRepo('Billet')->findBillets();

        return $this->render('BlogBundle::index.html.twig', array(
            'billets' => $billets
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


        return $this->render('BlogBundle:Billets:billetsAdmin.html.twig');
    }

    public function commentsAdminAction()
    {
        $comments = $this->getRepo('Comment')->findAllComments();

        return $this->render('BlogBundle:Comments:commentsAdmin.html.twig', array(
            'comments' => $comments
        ));
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
