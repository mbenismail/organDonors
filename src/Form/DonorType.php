<?php

namespace App\Form;

use App\Entity\Donor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DonorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('Email')
            ->add('Phone')
            ->add('age')
            ->add('weight')
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
