<?php

namespace Acme\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddActionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $components = array(
            'User:1' => '[User] Chuck Norris',
            'User:2' => '[User] Vic Mac Mkey',
            'User:3' => '[User] Walter White',
            'Car:alfaromeo-159'  => '[Car] Alfa romeo 159',
            'Car:bugatti-veyron'  => '[Car] Bugatti Veyron',
        );

        $verbs = array(
            'own'   => 'own',
            'drive' => 'drive',
            'kick'  => 'kick',
            'cook'  => 'cook',
        );

        $builder
            ->add('subject', 'choice', array(
                'choices' => $components
            ))
            ->add('verb', 'choice', array(
                'choices' => $verbs
            ))
            ->add('complementObject', 'choice', array(
                'choices' => $components,
                'required' => false,
            ))
            ->add('complementText', 'text', array(
                'required' => false,
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\DemoBundle\Form\Model\Action'
        ));
    }

    public function getName()
    {
        return 'acme_demobundle_action_type';
    }
}
