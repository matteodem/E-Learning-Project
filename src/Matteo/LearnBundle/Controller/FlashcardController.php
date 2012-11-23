<?php

namespace Matteo\LearnBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Matteo\LearnBundle\Entity\Flashcard;
use Matteo\LearnBundle\Form\FlashcardType;

/**
 * Flashcard controller.
 *
 */
class FlashcardController extends Controller
{
    /**
     * For adding new Flashcards to a cardbox.
     *
     */
     
    /*
    public function addAction(Request $request, $id)
    {
        $entity = new Flashcard();
        $cardboxForm = $this->createForm(new FlashcardType(), $entity);
        
        $entity = $em->getRepository('MatteoLearnBundle:FlashcardRepository')->();
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find the Category entity.');
        }
        
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CategoryType(), $entity);
        $editForm->bind($request);
        
        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('learn_category_edit', array('id' => $id)));
        }
        
        return $this->render('MatteoLearnBundle:Category:addCards.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    */
}
