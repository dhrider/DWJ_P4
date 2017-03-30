<?php
// src/BlogUserBundle/Controller/SecurityController.php

namespace BlogUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        // si déja identifié on redirige vers la page d'aministration
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED'))
            return $this->redirectToRoute('blog_admin');

        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render('BlogUserBundle::login.html.twig', array(
           'last_username' => $authenticationUtils->getLastUsername(),
            'error'        => $authenticationUtils->getLastAuthenticationError()
        ));
    }
}