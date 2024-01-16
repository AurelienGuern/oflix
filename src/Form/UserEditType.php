<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Courriel',
                'empty_data'    => '',
            ])
            ->add('roles', ChoiceType::class, [
                'multiple'      => false,
                'expanded'      => true,
                'choices'       => [
                    'administrateur'    => 'ROLE_ADMIN',
                    'manager'           => 'ROLE_MANAGER',
                    'utilisateur'       => 'ROLE_USER',
                ],
                'empty_data'    => '',
                'label_attr'    => [
                    'class'     => 'checkbox-inline',
                ],
            ])
            ->add('password', PasswordType::class, [
                'empty_data'    => '',
                // REFER : https://symfony.com/doc/6.4/reference/forms/types/password.html#mapped
                // Ce champ n'est plus mappé entre le formulaire et l'entité
                // les modifications faites dans le formulaire ne seront pas directement répercutées dans l'entité
                'mapped'        => false,
                'attr'          => [
                    'placeholder'   => 'Laissez vide si le mot de passe est inchangé',
                ],
            ])
            // REFER : https://symfony.com/doc/current/form/data_transformers.html#example-1-transforming-strings-form-data-tags-from-user-input-to-an-array
            ->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($tagsAsArray): string {
                    // transform the array to a string
                    return implode(', ', $tagsAsArray);
                },
                function ($tagsAsString): array {
                    // transform the string back to an array
                    return explode(', ', $tagsAsString);
                }
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
