<?php

namespace App\Form;

use App\Entity\Appointement;
use App\Entity\Donor;
use App\Entity\Hospital;
use App\Entity\Patient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppointementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('AppTime' , DateTimeType::class ,  ['label'=> 'Appointment date and time'])
            ->add('hospital' , EntityType::class , [
                'class' => Hospital::class,
                'choice_label' => 'Name_hosp',
            ])
            ->add('patient' , EntityType::class , [
                'class' => Patient::class,
                'placeholder' => 'Choose a patient',
                'required' => false,
                'choice_label' => 'Fullname',
            ])
            ->add('donor' , EntityType::class , [
                'class' => Donor::class,
                'placeholder' => 'Choose an donor',
                'required' => false,
                'choice_label' => 'Fullname',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Appointement::class,
        ]);
    }
}
