<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'row_attr' => ['class' => 'input-group'],
                'attr' => ['class' => 'form-input'],
                'label' => 'Nom'
            ])
            ->add('prenom', TextType::class, [
                'row_attr' => ['class' => 'input-group'],
                'attr' => ['class' => 'form-input'],
                'label' => 'Prénom'
            ])
            ->add('adresse', TextType::class, [
                'row_attr' => ['class' => 'long-input-group'],
                'attr' => ['class' => 'long-form-input'],
                'label' => 'Adresse',
                'required' => false
            ])
            ->add('codePostal', NumberType::class, [
                'row_attr' => ['class' => 'input-group'],
                'attr' => ['class' => 'form-input'],
                'label' => 'Code Postal',
                'required' => false,
                'constraints' => [
                    new Length([
                        'min' => 5,
                        'minMessage' => 'Votre code postal doit comporter au moins {{ limit }} caractères',
                        'max' => 5,
                        'maxMessage' => 'Votre code postal doit comporter au maximum {{ limit }} caractères'
                    ])
                ]
            ])
            ->add('ville', TextType::class, [
                'row_attr' => ['class' => 'input-group'],
                'attr' => ['class' => 'form-input'],
                'label' => 'Ville',
                'required' => false
            ])
            ->add('email', EmailType::class, [
                'row_attr' => ['class' => 'input-group'],
                'attr' => ['class' => 'form-input'],
                'label' => 'Email'
            ])
            ->add('telephone', TextType::class, [
                'row_attr' => ['class' => 'input-group'],
                'attr' => ['class' => 'form-input'],
                'label' => 'Numéro de téléphone'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
