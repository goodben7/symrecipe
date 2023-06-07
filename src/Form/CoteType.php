<?php

namespace App\Form;

use App\Entity\CoteL1Genie;
use Faker\Provider\ar_EG\Text;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
class CoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tp1', TextType::class, [
                'required'   => true,
                'attr' =>  [
                    'class' => 'form-control',
                    'minlenght' => '1',
                    'maxlength' => '50'
                ],
                'label' => 'TP 1',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 1, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('tp2', TextType::class, [
                'required'   => true,
                'attr' =>  [
                    'class' => 'form-control',
                    'minlenght' => '1',
                    'maxlength' => '50'
                ],
                'label' => 'TP 2',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 1, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('interro1', TextType::class, [
                'required'   => true,
                'attr' =>  [
                    'class' => 'form-control',
                    'minlenght' => '1',
                    'maxlength' => '50'
                ],
                'label' => 'INTERRO 1',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 1, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('interro2', TextType::class, [
                'required'   => true,
                'attr' =>  [
                    'class' => 'form-control',
                    'minlenght' => '1',
                    'maxlength' => '50'
                ],
                'label' => 'INTERRO 2',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 1, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('etudiant', TextType::class, [
                'disabled' => true, 
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Full name',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4'
                ],
                'label' => 'Modifier cote'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CoteL1Genie::class,
        ]);
    }
}
