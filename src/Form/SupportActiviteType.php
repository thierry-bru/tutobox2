<?php

namespace App\Form;

use App\Entity\ActiviteSeance;
use App\Entity\SupportActivite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SupportActiviteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fileName')
            ->add('filename')
            ->add('activiteSeance', EntityType::class, [
                'class' => ActiviteSeance::class,
'choice_label' => 'id',
            ])
            ->add('activite', EntityType::class, [
                'class' => ActiviteSeance::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SupportActivite::class,
        ]);
    }
}
