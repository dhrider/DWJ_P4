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
        $billets = $this->getRepository('Billet')->findBillets();

        return $this->render('BlogBundle::index.html.twig', array(
            'billets' => $billets
        ));
    }

    public function asideAction()
    {
        $billetsAside = $this->getRepository('Billet')->findFiveLastBillets();

        $commentAside = $this->getRepository('Comment')->findFiveLastComments();

        return $this->render('BlogBundle::aside.html.twig', array(
            'billetAside' => $billetsAside,
            'commentAside' => $commentAside
        ));
    }

    public function billetAction(Request $request)
    {
        $billet = $this->getRepository('Billet')->find($request->get('id'))
        ;

        $comments = $this->getRepository('Comment')->findCommentsByBilletId($billet->getId());

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

    public function getRepository($repository)
    {
        $result = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BlogBundle:'.$repository)
        ;

        return $result;
    }
}
