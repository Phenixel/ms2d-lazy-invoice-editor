<?php

namespace App\Form;

use App\Entity\Entreprise;
use App\Entity\Formateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('mail')
            ->add('adressePostal')
            ->add('codePostal')
            ->add('tel')
            ->add('siret')
            ->add('entreprises', EntityType::class, [
                'class' => Entreprise::class,
                'choice_label' => 'nom', // Afficher le nom de l'entreprise
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formateur::class,
        ]);
    }
}
