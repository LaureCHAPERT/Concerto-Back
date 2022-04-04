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
            ->add('slug')
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
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
