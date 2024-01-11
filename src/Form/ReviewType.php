<?php

namespace App\Form;

use App\Entity\Movie;
use App\Entity\Review;
use DateTimeImmutable;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => "Nom d'utilisateur",
            ])
            ->add('email', EmailType::class, [
                'label' => "Email de l'utilisateur",
            ])
            ->add('content', TextareaType::class, [
                'label' => "Texte de votre critique",
            ])
            ->add('rating', ChoiceType::class, [
                // REFER : https://symfony.com/doc/6.4/reference/forms/types/choice.html#placeholder
                'placeholder' => 'choisissez une option',
                'choices'  => [
                    'Excellent'         => 5,
                    'Très bon'          => 4,
                    'Bon'               => 3,
                    'Peut mieux faire'  => 2,
                    'A éviter'          => 1,
                ],
                'label' => "Votre appréciation",
            ])
            ->add('reactions', ChoiceType::class, [
                // REFER : https://symfony.com/doc/6.4/reference/forms/types/choice.html#select-tag-checkboxes-or-radio-buttons
                'expanded' => true,
                'multiple' => true,
                'choices'  => [
                    'Rire'      => 'smile',
                    'Pleurer'   => 'cry',
                    'Réfléchir' => 'think',
                    'Dormir'    => 'sleep',
                    'Rêver'     => 'dream',
                ],
                'label' => "Ce film vous a fait :",
            ])
            ->add('watchedAt', DateType::class, [
                'label'     => "Quand avez vous vu ce film",
                'widget'    => 'single_text',
                'input'     => 'datetime_immutable',
                'empty_data' => (new \DateTimeImmutable())->format('d/m/Y'),
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
