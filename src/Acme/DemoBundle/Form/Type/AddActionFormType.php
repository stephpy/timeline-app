<?php

namespace Acme\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * AddActionFormType
 *
 * @uses AbstractType
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class AddActionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $components = array(
            'User:chuck' => '[User] Chuck Norris',
            'User:vic' => '[User] Vic Mac Mkey',
            'User:walter' => '[User] Walter White',
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
