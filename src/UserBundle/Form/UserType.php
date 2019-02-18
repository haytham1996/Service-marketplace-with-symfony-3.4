<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('phoneNumber')->add('nom')->add('prenom')
        ->add('age')
        ->add('adresse')
        ->add('gender', ChoiceType::class, array(
        'choices' => array('female' => 'f', 'male' => 'm'),
        'choices_as_values' => true,
        'expanded' => true,
    ));
        //->add('lat',HiddenType::class)->add('lng',HiddenType::class);
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }


}
