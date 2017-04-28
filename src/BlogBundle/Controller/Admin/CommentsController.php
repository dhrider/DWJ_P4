<?php
//src/BlogBundle/Controller/Admin/CommentsController.php

namespace BlogBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

class CommentsController extends Controller
{
    // page d'administration des commentaires
    /**
     * @param $page
     * @Route("/admin/comment/{page}", name="blog_admin_comments_paginated", defaults={"page" = 1})
     * @Template()
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function adminCommentsAction($page = 1)
    {
        $em  = $this->getDoctrine()->getManager();

        // gestion de la pagination
        $adapter = new DoctrineORMAdapter($em->getRepository('BlogBundle:Comment')->findAllCommentsPaginated());
        $pager = new Pagerfanta($adapter);
        $pager->setMaxPerPage(10);
        $pager->setCurrentPage($page);

        return $this->render('BlogBundle:Comments:commentsAdmin.html.twig', array(
            'pager' => $pager
        ));
    }

    // page d'administration des commentaires d'un billet en fonction de l'id du billet

    public function adminCommentsByBilletAction(Request $request)
    {
        $em  = $this->getDoctrine()->getManager();

        // on récupère les commentaires liés au billet(id)
        $comments = $em->getRepository('BlogBundle:Comment')->findCommentsByBilletId($request->get('id'));

        // on récupère le billet concerné
        $billet = $em->getRepository('BlogBundle:Billet')->find($request->get('id'));

        // on render la vue avec les commentaires et le billet en argument
        return $this->render('BlogBundle:Comments:commentsByBilletAdmin.html.twig', array(
            'comments' => $comments,
            'billet' => $billet
        ));
    }

    // page d'administration des commentaires d'un auteur en fonction de l'id de l'auteur
    public function adminCommentsByAuthorAction(Request $request)
    {
        $em  = $this->getDoctrine()->getManager();

        // on récupère les commentaires liés à l'auteur(id)
        $comments = $em->getRepository('BlogBundle:Comment')->findCommentsByAuthor($request->get('author'));

        // on render la vue avec les commentaires et l'auteur en argument
        return $this->render('BlogBundle:Comments:commentsByAuthorAdmin.html.twig', array(
            'comments' => $comments,
            'author' => $request->get('author')
        ));
    }

    // page d'administration des commentaires signalés
    public function adminCommentsSignaledAction()
    {
        $em  = $this->getDoctrine()->getManager();

        // on récupère les commentaires signalés
        $comments = $em->getRepository('BlogBundle:Comment')->findCommentsSignaled();

        return $this->render('BlogBundle:Comments:commentsSignaledAdmin.html.twig', array(
            'comments' => $comments
        ));
    }

    // page (non affichée) de suppression des commentaires
    public function adminCommentDeleteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        // on récupère le commentaire en fonction de son id
        $comment =$em->getRepository('BlogBundle:Comment')->find($request->get('id'));

        // si aucun commentaire trouvé on lance un exception
        if (null === $comment)
        {
            throw new NotFoundHttpException("Le commentaire d'id ".$request->get('id')." n'existe pas.");
        }

        // on supprime le commentaire
        $em->remove($comment);
        $em->flush();

        // on redirige vers la page d'administration des commentaires
        return $this->redirectToRoute('blog_adminComments');
    }

    // page d'adition des commentaires
    public function adminCommentEditAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        // on récupère le commentaire en fonction de son id
        $comment =$em->getRepository('BlogBundle:Comment')->find($request->get('id'));

        // si aucun commentaire trouvé on lance un exception
        if (null === $comment)
        {
            throw new NotFoundHttpException("Le commentaire d'id ".$request->get('id')." n'existe pas.");
        }

        // on passe le signalement du commentaire à false
        $comment->setSignaled(false);
        // on passe la date de signalement à null
        $comment->setDateSignaled(null);

        $em->persist($comment);
        $em->flush();

        // on redirige vers la page d'administration des commentaires
        return $this->redirectToRoute('blog_adminComments');
    }
}
