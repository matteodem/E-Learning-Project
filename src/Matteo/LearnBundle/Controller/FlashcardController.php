<?php

namespace Matteo\LearnBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Matteo\LearnBundle\Entity\Flashcard;
use Matteo\LearnBundle\Form\FlashcardType;
use Matteo\LearnBundle\Entity\Cardbox;

/**
 * Flashcard controller.
 *
 */
class FlashcardController extends Controller
{
    /**
     * Create Form adding or editing existing Flashcards to a specified cardbox.
     *
     */
    public function addOrEditAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $currentCardbox = $em->getRepository('MatteoLearnBundle:Cardbox')->find($id);
        
        $entity = new Flashcard();
        $form = $this->createForm(new FlashcardType(), $entity);
        

        // $entity = $em->getRepository('MatteoLearnBundle:FlashcardRepository')->();
        
        return $this->render('MatteoLearnBundle:Flashcard:addCards.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'cardbox'=> $currentCardbox,
        ));
    }
    
    /**
     * Create Action for a specified cardbox.
     *
     */
    public function createAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $currentCardbox = $em->getRepository('MatteoLearnBundle:Cardbox')->find($id);
        
        // $entity = $em->getRepository('MatteoLearnBundle:FlashcardRepository')->findFlashcardsWithCardbox($id);
        
        $entity = new Flashcard();
        $entity->setCardbox($currentCardbox);
        $form = $this->createForm(new FlashcardType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('learn_cardbox_show', array('id' => $currentCardbox->getId())));
        }

        return $this->render('MatteoLearnBundle:Flashcard:addCards.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'cardbox'=> $currentCardbox,
        ));
    }
}
