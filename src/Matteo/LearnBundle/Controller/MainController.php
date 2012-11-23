<?php

namespace Matteo\LearnBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
}
