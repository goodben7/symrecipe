<?php

namespace App\Form;

use App\Entity\EtudiantL1Genie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;


class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'required'   => true,
                'attr' =>  [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlength' => '50'
                ],
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('postnom', TextType::class, [
                'required'   => true,
                'attr' =>  [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlength' => '50'
                ],
                'label' => 'Postnom',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('prenom', TextType::class, [
                'required'   => true,
                'attr' =>  [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlength' => '50'
                ],
                'label' => 'Prenom',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('sexe', ChoiceType::class, [
                'required'   => true,
                'choices' => [
                    'Homme' => 'M',
                    'Femme' => 'F'
                ],
                'attr' =>  [
                    'class' => 'form-control',
                    'minlenght' => '1',
                    'maxlength' => '1'
                ],
                'label' => 'Sexe',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 1, 'max' => 1])
                ]

            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4'
                ],
                'label' => 'Créer Etudaint'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EtudiantL1Genie::class,
        ]);
    }
}
