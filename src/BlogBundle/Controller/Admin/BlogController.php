<?php

namespace BlogBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use BlogBundle\Form\Type\BilletType;
use BlogBundle\Entity\Billet;

class BlogController extends Controller
{
    public function adminBilletsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $billets = $em->getRepository('BlogBundle:Billet')->findBillets();

        return $this->render('BlogBundle:Billets:billetsAdmin.html.twig', array(
            'billets' => $billets
        ));
    }

    public function adminBilletDeleteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $billet = $em->getRepository('BlogBundle:Billet')->find($request->get('id'));

        if (null == $billet)
        {
            throw new NotFoundHttpException("Le billet d'id ".$request->get('id')." n'existe pas.");
        }

        $em->remove($billet);
        $em->flush();

        return $this->redirectToRoute('blog_adminBillets');
    }

    public function adminBilletEditAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $billet = $em->getRepository('BlogBundle:Billet')->find($request->get('id'));

        if (null == $billet)
        {
            throw new NotFoundHttpException("Le billet d'id ".$request->get('id')." n'existe pas.");
        }

        $form = $this->createForm(BilletType::class, $billet);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $billet->setDateUpdate(new \DateTime());
            $billet->setTitle($form->getData()->getTitle());
            $billet->setContent($form->getData()->getContent());

            $em->persist($billet);
            $em->flush();

            return $this->redirectToRoute('blog_adminBillets');
        }

        return $this->render('BlogBundle:Billets:editBilletAdmin.html.twig', array(
            'billet' => $billet,
            'form' => $form->createView()
        ));
    }

    public function adminBilletAddAction(Request $request)
    {
        $billet = new Billet();

        $form = $this->createForm(BilletType::class, $billet);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em  = $this->getDoctrine()->getManager();
            $em->persist($billet);
            $em->flush();

            return $this->redirectToRoute('blog_adminBillets');
        }

        return $this->render('BlogBundle:Billets:addBilletAdmin.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
