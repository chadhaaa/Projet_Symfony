<?php

namespace App\Form;

use App\Entity\Offer;
use App\Entity\Category; 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class OfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('salaire')
            ->add('disponibility', ChoiceType::class, [
                'choices' => [
                    'Yes' => 'Yes',
                    'No' => 'No', 
                ],
            ])
            ->add('description')
            ->add('recruteur')
            ->add('location', ChoiceType::class, [
                'choices' => [
                    'En ligne' => 'En ligne',
                    'Sur place' => 'Sur place', 
                    'Hybride' => 'Hybride', 
                ], 
            ])
            ->add('createdAt')
        
                
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Offer::class,
        ]);
    }
}
