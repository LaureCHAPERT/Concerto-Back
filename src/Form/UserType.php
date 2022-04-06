<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('image')
            ->add('email')
            ->add('password')
            ->add('roles', ChoiceType::class, [
                'label' => 'Rôle',
                'choices'=> [
                    'Catalog Manager' => 'Catalog-Manager',
                    'Moderateur' => 'Moderator',
                    'Admin' => 'Admin',
                ],
                'multiple' => false,
                'expanded' => true,

            ])
            ->add('active', ChoiceType::class, [
                'choices' => [
                    'Oui' => 1,
                    'Non' => 0,
                ]
            ])
            ->add('regions')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
