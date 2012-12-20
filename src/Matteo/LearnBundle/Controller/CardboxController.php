<?php

namespace Matteo\LearnBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityRepository;

use Matteo\LearnBundle\Entity\Cardbox;
use Matteo\LearnBundle\Form\CardboxType;
use Matteo\LearnBundle\Form\CardboxRepository;
use Matteo\LearnBundle\Entity\Flashcard;
use Matteo\LearnBundle\Entity\FlashcardRepository;

/**
 * Cardbox controller.
 *
 */
class CardboxController extends Controller
{
    /**
     * Lists all Cardbox entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MatteoLearnBundle:Cardbox')->findAllPublicCardboxes();

        return $this->render('MatteoLearnBundle:Cardbox:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    /**
     * Lists all Cardbox entities within one Category
     *
    */
    public function categoryAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entities = $em->getRepository('MatteoLearnBundle:Cardbox')->findCardboxesWithCategoryId($id);
        
        if ($entities) {
            $category = $entities[0]->getCategory();
        }
        
        
        return $this->render('MatteoLearnBundle:Cardbox:index.html.twig', array(
            'entities' => $entities,
            'category' => $category,
        ));
    }

    /**
     * Finds and displays a Cardbox entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $cardbox = $em->getRepository('MatteoLearnBundle:Cardbox')->find($id);

        if (!$cardbox) {
            throw $this->createNotFoundException('Unable to find Cardbox entity.');
        }
        
        $flashcards = $em->getRepository('MatteoLearnBundle:Flashcard')->findFlashcardsWithCardbox($id);

        return $this->render('MatteoLearnBundle:Cardbox:show.html.twig', array(
            'cardbox'      => $cardbox,
            'flashcards'   => $flashcards,
        ));
    }

    /**
     * Displays a form to create a new Cardbox entity.
     *
     */
    public function newAction()
    {
        $entity = new Cardbox();
        $cardboxForm = $this->createForm(new CardboxType(), $entity);

        return $this->render('MatteoLearnBundle:Cardbox:new.html.twig', array(
            'entity' => $entity,
            'form'   => $cardboxForm->createView(),
        ));
    }

    /**
     * Creates a new Cardbox entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Cardbox();
        $form = $this->createForm(new CardboxType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('learn_cardbox_show', array('id' => $entity->getId(), 'cardbox' => $entity->getCardboxSlug())));
        }

        return $this->render('MatteoLearnBundle:Cardbox:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Cardbox entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MatteoLearnBundle:Cardbox')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cardbox entity.');
        }

        $editForm = $this->createForm(new CardboxType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MatteoLearnBundle:Cardbox:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Cardbox entity.
     *
     */
    public function updateAction(Request $request, $id, $cardbox)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MatteoLearnBundle:Cardbox')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cardbox entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CardboxType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('learn_cardbox_show', array('id' => $id, 'cardbox' => $cardbox)));
        }

        return $this->render('MatteoLearnBundle:Cardbox:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Cardbox entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MatteoLearnBundle:Cardbox')->find($id);
            
            $flashcards = $em->getRepository('MatteoLearnBundle:Flashcard')->findFlashcardsWithCardbox($id);

            if ($flashcards) {
                // Delete existing entries
                foreach ($flashcards as $flashcard) {
                    $em->remove($flashcard);
                }
            }

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cardbox entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('learn_cardbox'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
