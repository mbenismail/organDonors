<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Hospital;
use App\Entity\User;
use App\Form\DataTransformer\StringToArrayTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new StringToArrayTransformer();
        $builder
            ->add('email')
            ->add('username')

            ->add($builder->create('roles', ChoiceType::class, array(
                'multiple' => false,
                'choices' => array(
                    'ROLE_ADMIN' => 'ROLE_ADMIN',
                    'ROLE_EMP' => 'ROLE_EMP',
                )
            ))->addModelTransformer($transformer))
            ->add('hospital' , EntityType::class , [
                'class' => Hospital::class,
                'choice_label' => 'Name_hosp',
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'first_options'  => ['label' => 'Password'],
                'required' =>false,
                'second_options' => ['label' => 'Repeat Password'],
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
