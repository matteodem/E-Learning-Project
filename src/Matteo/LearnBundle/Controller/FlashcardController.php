<?php

namespace Matteo\LearnBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Matteo\LearnBundle\Entity\Flashcard;
use Matteo\LearnBundle\Entity\FlashcardRepository;
use Matteo\LearnBundle\Form\FlashcardType;
use Matteo\LearnBundle\Entity\Cardbox;

/**
 * Flashcard controller.
 *
 */
class FlashcardController extends Controller
{
    
    /**
     * The action created for learning the flashcards
     *
     */
    public function learnAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $cardbox = $em->getRepository('MatteoLearnBundle:Cardbox')->find($id);

        if (!$cardbox) {
            throw $this->createNotFoundException('Unable to find Cardbox entity.');
        }
        
        $flashcards = $em->getRepository('MatteoLearnBundle:Flashcard')->findFlashcardsWithCardbox($id);

        return $this->render('MatteoLearnBundle:Flashcard:learn.html.twig', array(
            'cardbox'      => $cardbox,
            'flashcards'   => $flashcards,
        ));
    }
    
    /**
     * Create Form adding or editing existing Flashcards to a specified cardbox.
     *
     */
    public function addOrEditAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $currentCardbox = $em->getRepository('MatteoLearnBundle:Cardbox')->find($id);
        $entity = new Flashcard();
        
        // Create a form for creating a new Flashcard
        $newFlashcard = new FlashcardType();
        $newFlashcard->setName('learn_flashcard_new0');
        $newFlashcardForm = $this->createForm($newFlashcard, $entity);
        // Get all the existing flashcards in the $currentCardbox
        $flashcards = $em->getRepository('MatteoLearnBundle:Flashcard')->findFlashcardsWithCardbox($id);
        // If there aren't any, just display the form without any prerenderd forms
        if (!$flashcards) {
            return $this->render('MatteoLearnBundle:Flashcard:edit.html.twig', array(
                'entity' => $entity,
                'form'   => $newFlashcardForm->createView(),
                'cardbox'=> $currentCardbox,
            ));
        }
        
        $forms = array();
        foreach ($flashcards as $key => $flashcard) {
            $formType = new FlashcardType();
            // Change the name, so the id's and name's won't be the same in the html markup
            $formType->setName('learn_flashcard_' . $key);
            // Create a form and put it all together in the $forms array
            $form    = $this->createForm($formType, $flashcard);
            $form    = $form->createView();
            $forms[] = $form;
        }
        
        return $this->render('MatteoLearnBundle:Flashcard:edit.html.twig', array(
            'entity' => $entity,
            'forms'  => $forms,
            'form'   => $newFlashcardForm->createView(),
            'cardbox'=> $currentCardbox,
        ));

    }
    
    /**
     * Create Action for a specified cardbox.
     *
     */
    public function updateAction(Request $request, $id, $cardbox)
    {
        $em = $this->getDoctrine()->getManager();
        
        $currentCardbox = $em->getRepository('MatteoLearnBundle:Cardbox')->find($id);
        if (!$currentCardbox) {
            throw $this->createNotFoundException('Unable to find Cardbox entity.');
        }
        
        $flashcards = $em->getRepository('MatteoLearnBundle:Flashcard')->findFlashcardsWithCardbox($id);
        
        if ($flashcards) {
            // Delete existing entries
            foreach ($flashcards as $flashcard) {
                $em->remove($flashcard);
            }
        }
        
        // Add edited + new cards
        $newCards = $request->request->all();
        
        foreach($newCards as $card) {
            $flashcard = new Flashcard();
            $flashcard->setFront($card['front']);
            $flashcard->setBack($card['back']);
            // Since it's optional
            if (isset($card['declaration'])) {
                $flashcard->setDeclaration($card['declaration']);
            }
            $flashcard->setCardbox($currentCardbox);
            
            $em->persist($flashcard);
        }
        
        // Finally flush everything
        $em->flush();
        
        return $this->redirect($this->generateUrl('learn_cardbox_show', array('id' => $id, 'cardbox' => $cardbox)));
    }
}
