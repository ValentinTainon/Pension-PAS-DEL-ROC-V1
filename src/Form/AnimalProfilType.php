<?php

namespace App\Form;

use App\Entity\Animal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints\Length;

class AnimalProfilType extends AbstractType
{
    const CHIEN = 'chien';
    const CHAT = 'chat';
    const MALE = 'mâle';
    const FEMELLE = 'femelle';

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'row_attr' => ['class' => 'input-group'],
                'attr' => ['class' => 'form-input'],
                'label' => 'Nom'])
            ->add('type', ChoiceType::class, [
                'row_attr' => ['class' => 'input-group'],
                'attr' => ['class' => 'choice-name'],
                'label' => 'Type',
                'choices' => ['Chien' => self::CHIEN, 'Chat' => self::CHAT],
                'expanded' => true])
            ->add('sexe', ChoiceType::class, [
                'row_attr' => ['class' => 'input-group'],
                'attr' => ['class' => 'choice-name'],
                'label' => 'Sexe',
                'choices' => ['Mâle' => self::MALE, 'Femelle' => self::FEMELLE],
                'expanded' => true])
            ->add('race', TextType::class, [
                'row_attr' => ['class' => 'input-group'],
                'attr' => ['class' => 'form-input'],
                'label' => 'Race'])
            ->add('age', TextType::class, [
                'row_attr' => ['class' => 'input-group'],
                'attr' => ['class' => 'form-input'],
                'label' => 'Age'])
            ->add('poids', NumberType::class, [
                'row_attr' => ['class' => 'input-group'],
                'attr' => ['class' => 'form-input'],
                'label' => 'Poids (kg)'])
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
                    ])]
                ])
            ->add('sterilisation', ChoiceType::class, [
                'row_attr' => ['class' => 'input-group'],
                'attr' => ['class' => 'choice-name'],
                'label' => 'Stérilisé / Castré ?',
                'choices' => ['Oui' => true, 'Non' => false], 
                'expanded' => true])
            ->add('infoSup', TextareaType::class, [
                'row_attr' => ['class' => 'textarea-group'],
                'label' => 'Informations supplémentaires',
                'required' => false,
                'attr' => [
                    'class' => 'profil-textarea-input',
                    'placeholder' => 'Précautions, caractère de l’animal, sociabilité, peurs, phobie, éducation, antécédents de santé, traitement médical en cours etc…']
                ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
