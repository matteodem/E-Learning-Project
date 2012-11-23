<?php

namespace Matteo\LearnBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CardboxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // $builder is the Cardbox Form
        $builder
            ->add('name')
            ->add('description', 'textarea')
            ->add('difficulty')
            ->add('is_private')
            ->add('front_side')
            ->add('back_side')
            ->add('category')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Matteo\LearnBundle\Entity\Cardbox',
             'cascade_validation' => true
        ));
    }

    public function getName()
    {
        return 'learn_linguabundle_cardboxtype';
    }
}
