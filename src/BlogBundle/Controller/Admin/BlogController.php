<?php
//src/BlogBundle/Controller/Admin/BlogController.php

namespace BlogBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use BlogBundle\Form\Type\BilletType;
use BlogBundle\Entity\Billet;

class BlogController extends Controller
{
    // Page administration des billets
    public function adminBilletsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $billets = $em->getRepository('BlogBundle:Billet')->findBillets();

        return $this->render('BlogBundle:Billets:billetsAdmin.html.twig', array(
            'billets' => $billets
        ));
    }

    // Page (non affichée) gérant la suppression d'un billet
    public function adminBilletDeleteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $billet = $em->getRepository('BlogBundle:Billet')->find($request->get('id'));

        // si aucun billet avec l'id demandé n'est trouvé, on lance un exception
        if (null === $billet)
        {
            throw new NotFoundHttpException("Le billet d'id ".$request->get('id')." n'existe pas.");
        }

        $em->remove($billet); // on supprime le billet
        $em->flush();

        // on redirige sur le page d'administration des billets
        return $this->redirectToRoute('blog_adminBillets');
    }

    // Page d'édition d'un billet
    public function adminBilletEditAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $billet = $em->getRepository('BlogBundle:Billet')->find($request->get('id'));

        // si aucun billet avec l'id demandé n'est trouvé, on lance un exception
        if (null === $billet)
        {
            throw new NotFoundHttpException("Le billet d'id ".$request->get('id')." n'existe pas.");
        }

        // On crée le formulaire avec le billet trouvé
        $form = $this->createForm(BilletType::class, $billet);

        // si la méthode est 'POST' et que le formulaire est valide
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $billet->setDateUpdate(new \DateTime()); // On set la date d'update à la date de l'instant présent
            $billet->setTitle($form->getData()->getTitle()); // On set le titre
            $billet->setContent($form->getData()->getContent()); // On set le contenu

            $em->persist($billet);
            $em->flush();

            // on redirige sur le page d'administration des billets
            return $this->redirectToRoute('blog_adminBillets');
        }

        // Si pas de 'POST' on render la page d'édition avec le billet et le formulaire vide
        return $this->render('BlogBundle:Billets:editBilletAdmin.html.twig', array(
            'billet' => $billet,
            'form' => $form->createView()
        ));
    }

    // Page (non affichée) d'ajout d'un billet
    public function adminBilletAddAction(Request $request)
    {
        // On crée le nouveau billet
        $billet = new Billet();

        // On crée le formulaire avec le nouveau billet
        $form = $this->createForm(BilletType::class, $billet);

        // si la méthode est 'POST' et que le formulaire est valide
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            // On ajoute le nouveau billet rempli
            $em  = $this->getDoctrine()->getManager();
            $em->persist($billet);
            $em->flush();

            // on redirige sur le page d'administration des billets
            return $this->redirectToRoute('blog_adminBillets');
        }

        // Si pas de 'POST' on render la page d'ajout avec le formulaire vide
        return $this->render('BlogBundle:Billets:addBilletAdmin.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
