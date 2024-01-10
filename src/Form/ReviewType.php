<?php

namespace App\Form;

use App\Entity\Movie;
use App\Entity\Review;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('content')
            ->add('rating', ChoiceType::class, [
                'choices' => [
                    'HORRIBLE' => 1,
                    'Bof' => 2,
                    'Cool !' => 3,
                    'TOP TOP' => 4,
                    'INCR' => 5,
                ],
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('reactions', ChoiceType::class, [
                'choices' => [
                    'Rire' => 1,
                    'Pleurer' => 2,
                    'Réfléchir' => 3,
                    'Dormir' => 4,
                    'Rêver' => 5,
                ],
                'multiple' => false,
                'expanded' => true,
            ])
            ->add('watchedAt')
            ->add('movie', EntityType::class, [
                'class' => Movie::class,
'choice_label' => 'id',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
