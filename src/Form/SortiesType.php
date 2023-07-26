<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\Sortie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class SortiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de la sortie :',
                'required' => true
            ])
            ->add('dateHeureDebut', DateType::class, [
                'label' => 'Date de la sortie :',
                'required' => true,
                'html5' => 'true',
                'widget' => 'single_text'
            ])
            ->add('dateLimiteInscription', DateType::class, [
                'label' => "Date limite d'inscription :",
                'required' => true,
                'html5' => 'true',
                'widget' => 'single_text'
            ])
            ->add('nbInscriptionsMax', NumberType::class, [
                'label' => 'Nombre de places :',
                'required' => true
            ])
            ->add('duree', IntegerType::class, [
                'label' => 'Durée de la sortie (en minute) :',
                'attr' => [
                    'inputmode' => 'numeric',
                    'step' => 1,
                ],
                'required' => false
            ])
            ->add('infosSortie', TextareaType::class, [
                'label' => 'Description et informations :',
                'attr' => [
                    'rows' => 3,
                ],
                'required' => true
            ])

            ->add('lieu', TextType::class, [
                'label' => 'Lieu de la sortie :',
                'required' => false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([

            'data_class' => Sortie::class,
        ]);

    }
}
