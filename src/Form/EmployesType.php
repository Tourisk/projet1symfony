<?php

namespace App\Form;

use App\Entity\Employes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EmployesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom')
            ->add('nom')
            ->add('telephone')
            ->add('email')
            ->add('adresse')
            ->add('poste')
            ->add('salaire')
            ->add('datedenaissance', DateType::class, [
                'placeholder'=> [
                    'year'=> 'Année',
                    'month'=> 'Mois',
                    'day'=> 'Jour'], 
                    "years"=> range(1920, 2020)
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employes::class,
        ]);
    }
}
