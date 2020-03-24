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
            ->add('isurgent', ChoiceType::class , ['label'=>'Is urgent case','choices' => [
                'No' => '0' ,
                'Yes' => '1'
            ]])
            ->add('organDonation', ChoiceType::class , ['label'=>'Please select the organ that patient need' , 'choices' => [
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
