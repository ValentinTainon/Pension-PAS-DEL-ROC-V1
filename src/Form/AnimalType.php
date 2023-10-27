<?php

namespace App\Form;

use App\Entity\Animal;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;

class AnimalType extends AbstractType
{
    const CHIEN = 'chien';
    const CHAT = 'chat';
    const MALE = 'mâle';
    const FEMELLE = 'femelle';

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('selectAnimal', EntityType::class, [
            //     'class' => Animal::class,
            //     'choices' => $user->getAnimals(),
            //     'attr' => ['class' => 'form-input'],
            //     'label' => false,
            //     'placeholder' => 'Sélectionner votre animal',
            //     'required' => false,
            // ])
            ->add('nom', TextType::class, [
                'row_attr' => ['class' => 'input-group'],
                'attr' => ['class' => 'form-input'],
                'label' => 'Nom'
            ])
            ->add('type', ChoiceType::class, [
                'row_attr' => ['class' => 'input-group'],
                'attr' => ['class' => 'choice-name'],
                'label' => 'Type',
                'choices' => ['Chien' => self::CHIEN, 'Chat' => self::CHAT],
                'expanded' => true
            ])
            ->add('sexe', ChoiceType::class, [
                'row_attr' => ['class' => 'input-group'],
                'attr' => ['class' => 'choice-name'],
                'label' => 'Sexe',
                'choices' => ['Mâle' => self::MALE, 'Femelle' => self::FEMELLE],
                'expanded' => true
            ])
            ->add('race', TextType::class, [
                'row_attr' => ['class' => 'input-group'],
                'attr' => ['class' => 'form-input'],
                'label' => 'Race'
            ])
            ->add('age', TextType::class, [
                'row_attr' => ['class' => 'input-group'],
                'attr' => ['class' => 'form-input'],
                'label' => 'Age'
            ])
            ->add('poids', NumberType::class, [
                'row_attr' => ['class' => 'input-group'],
                'attr' => ['class' => 'form-input'],
                'label' => 'Poids (kg)'
            ])
            ->add('numPuce', TextType::class, [
                'row_attr' => ['class' => 'input-group'],
                'attr' => ['class' => 'form-input'],
                'label' => 'N° de puce ou de tatouage',
                'constraints' => [
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Le numéro doit comporter au moins {{ limit }} caractères',
                        'max' => 15,
                        'maxMessage' => 'Le numéro doit comporter au maximum {{ limit }} caractères'
                    ])
                ]
            ])
            ->add('sterilisation', ChoiceType::class, [
                'row_attr' => ['class' => 'sterilisation-input-group'],
                'attr' => ['class' => 'choice-name'],
                'label' => 'Stérilisé / Castré ?',
                'choices' => ['Oui' => true, 'Non' => false],
                'expanded' => true
            ])
            ->add('dateChaleurs', TextType::class, [
                'label' => 'Date des dernières chaleurs',
                'attr' => ['class' => 'form-input datepicker'],
                'required' => true
            ])
            ->add('medical', ChoiceType::class, [
                'row_attr' => ['class' => 'input-group'],
                'attr' => ['class' => 'choice-name'],
                'label' => 'Traitement médical en cours ?',
                'choices' => ['Oui' => true, 'Non' => false],
                'expanded' => true
            ])
            ->add('ordonnance', FileType::class, [
                'label' => 'Je transmet l\'ordonnance',
                'help' => 'Formats de fichier supportés : jpg, jpeg, pdf',
                'mapped' => false,
                'required' => true,
                'constraints' => [new File([
                    'maxSize' => '1024k',
                    'mimeTypes' => [
                        'application/jpg',
                        'application/jpeg',
                        'application/pdf'
                    ],
                    'mimeTypesMessage' => 'Veuillez télécharger un document au format valide'
                ])]
            ])
            ->add('infoSup', TextareaType::class, [
                'row_attr' => ['class' => 'textarea-group'],
                'label' => 'Informations supplémentaires',
                'required' => false,
                'attr' => [
                    'class' => 'form-textarea-input',
                    'placeholder' => 'Précautions, caractère de l’animal, sociabilité, peurs, phobie, éducation, antécédents de santé, traitement médical en cours etc…'
                ]
            ])
            ->add('vaccins', CheckboxType::class, [
                'row_attr' => ['class' => 'checkbox-group'],
                'label' => 'À transmettre le carnet de santé à jour (vaccins, etc...) de mon animal lors de son arrivée'
            ])
            ->add('vermifuge', CheckboxType::class, [
                'row_attr' => ['class' => 'checkbox-group'],
                'label' => 'À ce que le traitement vermifuge ait moins de 3 mois durant la période de pension'
            ])
            ->add('alimentation', CheckboxType::class, [
                'row_attr' => ['class' => 'checkbox-group'],
                'label' => 'À fournir l’alimentation de mon animal lors de son arrivée (en quantité suffisante pour la durée du séjour)'
            ])
            ->add('traitement', CheckboxType::class, [
                'label' => 'À fournir le traitement adapté de mon animal lors de son arrivée
                (un supplément tarifaire de 1€ par prise sera appliqué sur place)'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
