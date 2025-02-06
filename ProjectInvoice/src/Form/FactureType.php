<?php

namespace App\Form;

use App\Entity\Facture;
use App\Entity\Formateur;
use App\Entity\InvoiceLine;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('month', DateTimeType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control', 
                ],
                'label_attr' => [
                    'class' => 'form-label fw-bold'
                ],
                'label' => 'Mois'
            ])
            ->add('createdAt', DateTimeType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control',
                ],
                'label_attr' => [
                    'class' => 'form-label fw-bold'
                ],
                'label' => 'Créé le'
            ])
            ->add('updatedAt', DateTimeType::class, [
                'widget' => 'single_text',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ],
                'label_attr' => [
                    'class' => 'form-label fw-bold'
                ],
                'label' => 'Mis à jour le'
            ])
            ->add('pdfPath', null, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Chemin du fichier PDF'
                ],
                'label_attr' => [
                    'class' => 'form-label fw-bold'
                ],
                'label' => 'Chemin du PDF'
            ])
            ->add('formateur_id', EntityType::class, [
                'class' => Formateur::class,
                'choice_label' => 'nom',
                'attr' => [
                    'class' => 'form-select'
                ],
                'label_attr' => [
                    'class' => 'form-label fw-bold'
                ],
                'label' => 'Formateur'
            ])
            ->add('invoiceInline', EntityType::class, [
                'class' => InvoiceLine::class,
                'choice_label' => 'Module',
                'multiple' => false,
                'expanded' => false,
                'attr' => [
                    'class' => 'form-select'
                ],
                'label_attr' => [
                    'class' => 'form-label fw-bold'
                ],
                'label' => 'Ligne de Facture (Module)'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }
}
