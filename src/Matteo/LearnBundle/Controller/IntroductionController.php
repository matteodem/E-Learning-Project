<?php

namespace Matteo\LearnBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IntroductionController extends Controller
{
    public function indexAction()
    {
        return $this->render('MatteoLearnBundle:Introduction:index.html.twig');
    }
    
    public function getstartedAction()
    {
        return $this->render('MatteoLearnBundle:Introduction:getstarted.html.twig');
    }
    
    public function coursesAction()
    {
        return $this->render('MatteoLearnBundle:Introduction:courses.html.twig');
    }
    
    public function interactionAction()
    {
        return $this->render('MatteoLearnBundle:Introduction:courses.html.twig');
    }
    
    public function communicationAction()
    {
        return $this->render('MatteoLearnBundle:Introduction:courses.html.twig');
    }
}
