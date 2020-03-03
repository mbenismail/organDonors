<?php

namespace App\Form;

use App\Entity\Hospital;
use App\Entity\Patient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('Fullname')
            ->add('Phone')
            ->add('Address')
            ->add('BloodType', ChoiceType::class , ['choices' => [
                'O−' => 'O−' ,
                'O+' => 'O+',
                'A−' => 'A−',
                'B−' => 'B−',
                'AB−' => 'AB−',
                'A+' => 'A+',
                'B+' => 'B+',
                'AB+' => 'AB+']] )
            ->add('hospital' , EntityType::class , [
                'class' => Hospital::class,
                'choice_label' => 'Name_hosp',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
