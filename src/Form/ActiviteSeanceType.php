<?php

namespace App\Form;

use App\Entity\ActiviteSeance;
use App\Entity\EtudeCasActivite;
use App\Entity\Materiel;
use App\Entity\ModaliteActivite;
use App\Entity\Seance;
use App\Entity\SerieExercices;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ActiviteSeanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titreActivite')
            ->add('consignes',TextareaType::class,[
                'attr'=>['rows'=>10,'class' => 'tinymce']
            ])
            ->add('duree')
            ->add('estComplete')
            ->add('ordre')
            ->add('exercices', EntityType::class, [
                'class' => SerieExercices::class,
'choice_label' => 'intitule',
            ])
            ->add('etudeDeCas', EntityType::class, [
                'class' => EtudeCasActivite::class,
'choice_label' => 'id',
            ])
            ->add('modalites', EntityType::class, [
                'class' => ModaliteActivite::class,
'choice_label' => 'intitule',
'multiple' => true,
            ])
            ->add('materiels', EntityType::class, [
                'class' => Materiel::class,
'choice_label' => 'intitule',
'multiple' => true,
            ])
            ->add('seance', EntityType::class, [
                'class' => Seance::class,
'choice_label' => 'intitule',
            ])
            ->add('supports')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ActiviteSeance::class,
        ]);
    }
}
