<?php

namespace App\Form;

use App\Entity\Donor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DonorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', null ,  array(
                'attr' => array('pattern' => '[a-zA-Z\s]{8,}' , 'title' => 'the first name must be alpha and 8 characters'
                )
            ))
            ->add('lastName', null ,  array(
                'attr' => array('pattern' => '[a-zA-Z\s]{8,}' , 'title' => 'The last name must be alpha and 8 characters ')
            ))
            ->add('Email')
            ->add('Phone')
            ->add('age' , null ,  array('label'=> 'Age (The age must be between 16 and 60)' ,
                'attr' => array('min' => 18, 'max' => 60)
                ))
            ->add('weight', null, array('label'=> 'Weight (The weight must be between 50 and 90)',
                'attr' => array('min' => 50, 'max' => 90)
            ))
            ->add('TypeDonation', ChoiceType::class , ['choices' => [
                'Before Death' => '0' ,
                'After Death' => '1'
               ]])
            ->add('organDonation', ChoiceType::class , ['choices' => [
                'Kidney' => 'Kidney' ,
                'Liver' => 'Liver' ,
                'Stem cells' => 'Stem cells' ,
            ]])
            ->add('BloodType', ChoiceType::class , ['choices' => [
                'O-' => 'O-' ,
                'O+' => 'O+',
                'A-' => 'A-',
                'B-' => 'B-',
                'AB-' => 'AB-',
                'A+' => 'A+',
                'B+' => 'B+',
                'AB+' => 'AB+']] )
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'first_options'  => ['label' => 'Password'],
                'required' =>true,
                'second_options' => ['label' => 'Repeat Password'],
            ])
            ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Donor::class,
        ]);
    }
}
