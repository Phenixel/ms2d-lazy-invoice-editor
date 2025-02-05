<?php

namespace App\Form;

use App\Entity\Entreprise;
use App\Entity\Formateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('mail')
            ->add('adressePostal')
            ->add('codepostal')
//            ->add('formateur_id', EntityType::class, [
//                'class' => Formateur::class,
//                'choice_label' => 'id',
//                'multiple' => true,
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entreprise::class,
        ]);
    }
}
