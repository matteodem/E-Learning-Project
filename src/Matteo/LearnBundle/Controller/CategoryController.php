<?php

namespace Matteo\LearnBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Matteo\LearnBundle\Entity\Category;
use Matteo\LearnBundle\Form\CategoryType;

/**
 * Category controller.
 *
 */
class CategoryController extends Controller
{
    /**
     * Lists all Category entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MatteoLearnBundle:Category')->findAll();
        
        // If there are different formats available
        $format = $this->getRequest()->getRequestFormat();
        
        return $this->render('MatteoLearnBundle:Category:index.' . $format . '.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Category entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MatteoLearnBundle:Category')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        return $this->render('MatteoLearnBundle:Category:show.html.twig', array(
            'entity'      => $entity,
            ));
    }
}
