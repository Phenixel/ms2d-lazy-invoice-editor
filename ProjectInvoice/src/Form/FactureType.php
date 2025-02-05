<?php

namespace App\Form;

use App\Entity\Facture;
use App\Entity\Formateur;
use App\Entity\InvoiceLine;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('month', DateTimeType::class, [
                'widget' => 'single_text',
            ])

            ->add('createdAt', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            // Pour 'updatedAt' (nullable), on utilise DateTimeType avec 'required' => false
            ->add('updatedAt', DateTimeType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('pdfPath')
           // ->add('total')
           ->add('formateur_id', EntityType::class, [
               'class' => Formateur::class,
               'choice_label' => 'nom', // Affiche le nom du formateur au lieu de l'id
           ])

//            ->add('invoiceInline', EntityType::class, [
//                'class' => InvoiceLine::class,
//                'choice_label' => 'Module', // Affiche le nom du formateur au lieu de l'id
//            ])
//            ->add('invoiceInline', CollectionType::class, [
//                'entry_type'    => \App\Form\InvoiceLineType::class,
//                'allow_add'     => true,
//                'allow_delete'  => true,
//                'by_reference'  => false,
//            ])


            ->add('invoiceInline', EntityType::class, [
                'class' => InvoiceLine::class,
                'choice_label' => 'Module',
                // On ne permet qu'une sélection (pas de multiple)
                'multiple'    => false,
                'expanded'    => false, // liste déroulante
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }
}
