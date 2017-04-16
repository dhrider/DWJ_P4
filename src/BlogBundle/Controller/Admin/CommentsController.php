<?php

namespace BlogBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;

class CommentsController extends Controller
{
    public function adminCommentsAction()
    {
        $em  = $this->getDoctrine()->getManager();

        $comments = $em->getRepository('BlogBundle:Comment')->findAllComments();

        return $this->render('BlogBundle:Comments:commentsAdmin.html.twig', array(
            'comments' => $comments
        ));
    }

    public function adminCommentsByBilletAction(Request $request)
    {
        $em  = $this->getDoctrine()->getManager();

        $comments = $em->getRepository('BlogBundle:Comment')->findCommentsByBilletId($request->get('id'));
        $billet = $em->getRepository('BlogBundle:Billet')->find($request->get('id'));

        return $this->render('BlogBundle:Comments:commentsByBilletAdmin.html.twig', array(
            'comments' => $comments,
            'billet' => $billet
        ));
    }

    public function adminCommentsByAuthorAction(Request $request)
    {
        $em  = $this->getDoctrine()->getManager();

        $comments = $em->getRepository('BlogBundle:Comment')->findCommentsByAuthor($request->get('author'));

        return $this->render('BlogBundle:Comments:commentsByAuthorAdmin.html.twig', array(
            'comments' => $comments,
            'author' => $request->get('author')
        ));
    }

    public function adminCommentsSignaledAction()
    {
        $em  = $this->getDoctrine()->getManager();

        $comments = $em->getRepository('BlogBundle:Comment')->findCommentsSignaled();

        return $this->render('BlogBundle:Comments:commentsSignaledAdmin.html.twig', array(
            'comments' => $comments
        ));
    }

    public function adminCommentDeleteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $comment =$em->getRepository('BlogBundle:Comment')->find($request->get('id'));

        if (null == $comment)
        {
            throw new NotFoundHttpException("Le commentaire d'id ".$request->get('id')." n'existe pas.");
        }

        $em->remove($comment);
        $em->flush();

        return $this->redirectToRoute('blog_adminComments');
    }

    public function adminCommentEditAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $comment =$em->getRepository('BlogBundle:Comment')->find($request->get('id'));

        if (null == $comment)
        {
            throw new NotFoundHttpException("Le commentaire d'id ".$request->get('id')." n'existe pas.");
        }

        $comment->setSignaled(false);

        $em->persist($comment);
        $em->flush();

        return $this->redirectToRoute('blog_adminComments');
    }
}
