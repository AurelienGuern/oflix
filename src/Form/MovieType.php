<?php

namespace App\Form;

use App\Entity\Genre;
use App\Entity\Movie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;



class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label'     => 'Titre du film ou de la série',
            ])
            ->add('releaseDate',DateType::class, [
                'widget'    => 'single_text',
                'input'     => 'datetime_immutable',
                'empty_data' => (new \DateTimeImmutable())->format('d/m/Y'),
            ])
            ->add('duration')
            ->add('summary')
            ->add('synopsis')
            ->add('poster')
            ->add('type', ChoiceType::class, [
                'choices'  => [
                    'Film'         => 'Film',
                    'Série'          => 'Série',
                  
                ],
                'label' => "Type ",
            ])
            ->add('genres', EntityType::class, [
                'class'         => Genre::class,
                'choice_label'  => 'name',
                'multiple'      => true,
                'expanded'      => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
