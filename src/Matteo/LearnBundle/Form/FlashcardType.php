<?php

namespace Matteo\LearnBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FlashcardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('front')
            ->add('back')
            ->add('declaration', 'textarea')
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
        return 'learn_linguabundle_flashcardtype';
    }
}
