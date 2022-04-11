<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Genre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',null,[
                'label'=> 'Nom'
            ])
            ->add('description')
            ->add('date')
            ->add('price',null,[
                'label'=> 'Prix'
            ])
            ->add('image')
            ->add('linkTicketing',null,[
                'label'=> 'Lien vers la billeterie'
            ])
            ->add('genres', EntityType::class, [
                'class'=> Genre::class,
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('region')
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        // CSRF documentation for forms
        // https://symfony.com/doc/5.4/security/csrf.html#csrf-protection-in-symfony-forms
        $resolver->setDefaults([
            'data_class' => Event::class,
            // enable/disable CSRF protection for this form
            'csrf_protection' => true,
            // the name of the hidden HTML field that stores the token
            'csrf_field_name' => '_token',
            // an arbitrary string used to generate the value of the token
            // using a different string for each form improves its security
            'csrf_token_id'   => 'event_item',
        ]);
    }
}
