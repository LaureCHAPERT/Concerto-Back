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
                    'Catalog Manager' => 'ROLE_MANAGER',
                    'Moderateur' => 'ROLE_MODERATOR',
                    'Admin' => 'ROLE_ADMIN',
                ],
                'multiple' => true,
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
        // CSRF documentation for forms
        // https://symfony.com/doc/5.4/security/csrf.html#csrf-protection-in-symfony-forms
        $resolver->setDefaults([
            'data_class' => User::class,
            // enable/disable CSRF protection for this form
            'csrf_protection' => true,
            // the name of the hidden HTML field that stores the token
            'csrf_field_name' => '_token',
            // an arbitrary string used to generate the value of the token
            // using a different string for each form improves its security
            'csrf_token_id'   => 'user_item',
        ]);
    }
}
