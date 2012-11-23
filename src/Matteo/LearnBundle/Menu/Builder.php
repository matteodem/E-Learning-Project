<?php

namespace Matteo\LearnBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\Renderer\ListRenderer;
use Knp\Menu\Matcher\Matcher;
use Symfony\Component\HttpFoundation\Request;

class Builder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }
        
    /**
     * Renders the Main Menu
     * @param Request $request
     */
    public function createMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');
        
        // Set Class as nav for Bootstrap
        $menu->setChildrenAttributes(array('class' => 'nav'));
        
        $menu->addChild('Categories',   array('route' => 'learn_category'));
        $menu->addChild('Cardboxes',    array('route' => 'learn_cardbox'));
        $menu->addChild('About',        array('route' => 'learn_about'));
        
        
        return $menu;
    }
    
    /**
     * Renders the Menu used for the /intro menu
     * @param Request $request
     */
    public function createIntroMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');
        
        // Set Class as nav for Bootstrap
        $menu->setChildrenAttributes(array('class' => 'nav'));
        
        $menu->addChild('Intro',            array('route' => 'learn_intro_homepage'));
        $menu->addChild('Get started',      array('route' => 'learn_intro_getstarted'));
        $menu->addChild('Courses',          array('route' => 'learn_intro_courses'));
        $menu->addChild('Interaction',      array('route' => 'learn_intro_interaction'));
        $menu->addChild('Communication',    array('route' => 'learn_intro_communication'));
        
        
        return $menu;
    }
}