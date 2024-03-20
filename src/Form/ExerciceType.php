<?php

namespace App\Form;

use App\Entity\Exercice;
use App\Entity\Seance;
use App\Entity\TypeExercice;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class ExerciceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('intitule')
            ->add('instructions')
            ->add('fichierSupport', FileType::class, [
                            'label' => 'Fichier Exercice',
            
                            // unmapped means that this field is not associated to any entity property
                            'mapped' => false,
            
                            // make it optional so you don't have to re-upload the PDF file
                            // every time you edit the Product details
                            'required' => false,
            
                            // unmapped fields can't define their validation using attributes
                            // in the associated entity, so you can use the PHP constraint classes
                            'constraints' => [
                                new File(
                                    [
                                        'maxSize' => '10024k',
    
                                    ]
                                )
                            ],
                        ])
            ->add('fichierCorrection', FileType::class, [
                'label' => 'Fichier Exercice',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using attributes
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File(
                        [
                            'maxSize' => '10024k',
                        ]
                    )
                ],
            ])
            ->add('type', EntityType::class, [
                'class' => TypeExercice::class,
                'choice_label' => 'intitule',
            ])
            ->add('seance', EntityType::class, [
                'class' => Seance::class,
                'choice_label' => 'intitule',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exercice::class,
        ]);
    }
}
