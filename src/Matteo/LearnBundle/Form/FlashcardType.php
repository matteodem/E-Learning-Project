<?php

namespace Matteo\LearnBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FlashcardType extends AbstractType
{
    private $name = 'learn_flashcard';
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('front', null, array(
                'attr' => array('class' => 'front')))
            ->add('back', null, array(
                    'attr' => array('class' => 'back')))
            ->add('declaration', 'textarea', array(
                    'attr' => array('class' => 'flashTextarea', 
                                    'rows' => 3)))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Matteo\LearnBundle\Entity\Flashcard'
        ));
    }

    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name){
        $this->name = $name;
    }
}
