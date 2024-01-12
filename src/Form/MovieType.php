<?php

namespace App\Form;

use App\Entity\Genre;
use App\Entity\Movie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label'         => 'Titre du film ou de la série',
                'empty_data'    => '',
            ])
            ->add('releaseDate', DateType::class, [
                'label'             => 'Date de sortie',
                'widget'    => 'single_text',
                'input'     => 'datetime_immutable',
                'empty_data' => (new \DateTimeImmutable())->format('d/m/Y'),
                'invalid_message'   => 'Veuillez entrer une date de sortie valide',
            ])
            ->add('duration', IntegerType::class, [
                'label'     => 'Durée du film ou de la série',
                'empty_data' => '0',
            ])
            ->add('summary', TextareaType::class, [
                'label'     => 'Résumé',
                'empty_data' => '',
            ])
            ->add('synopsis', null, [
                'label'     => 'Synopsis',
                'empty_data' => '',
            ])
            ->add('poster', UrlType::class, [
                'label'     => 'Affiche',
                'empty_data' => '',
            ])
            ->add('type', ChoiceType::class, [
                'label'     => 'Type',
                'multiple'  => false,
                'expanded'  => true,
                'choices'   => [
                    'Film'  => 'Film',
                    'Série' => 'Série',
                ],
                'empty_data' => '',
            ])
            ->add('genres', EntityType::class, [
                'class'         => Genre::class,
                'choice_label'  => 'name',
                'multiple'      => true,
                'expanded'      => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
