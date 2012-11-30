<?php

namespace Matteo\LearnBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class MainController extends Controller
{
    public function indexAction()
    {
        return $this->render('MatteoLearnBundle:Main:index.html.twig', array('name' => 'test'));
    }
    
    public function aboutAction()
    {
        return $this->render('MatteoLearnBundle:Main:about.html.twig', array('test' => "test"));
    }
    
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('MatteoLearnBundle:Admin:login.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }
}
