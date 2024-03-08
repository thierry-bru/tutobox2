<?php

namespace App\Form;

use App\Entity\Seance;
use App\Entity\Sequence;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('intitule')
            ->add('objectifs')
            ->add('estComplete')
            ->add('sequence', EntityType::class, [
                'class' => Sequence::class,
'choice_label' => 'title',
            ])
            ->add('ordre')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Seance::class,
        ]);
    }
}
