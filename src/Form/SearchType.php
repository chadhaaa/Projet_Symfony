<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('job', ChoiceType::class, [
                'choices' => [
                    'développeur web' => 'développeur web',
                    'développeur base de données' => 'développeur base de données', 
                    'architecte d’information' => 'architecte d’information', 
                    'technicien réseau' => 'technicien réseau', 
                    'intégrateur web' => 'intégrateur web', 
                    'expert en sécurité' => 'expert en sécurité',
                    'illustrateur 3D' => 'illustrateur 3D', 
                    'web designer' => 'web designer', 
                    'graphiste web' => 'graphiste web', 
                    'web marketeur' => 'web marketeur', 
                    'concepteur web' => 'concepteur web', 
                    'assistant chef de projet' => 'assistant chef de projet', 
                    'chef de projet digital' => 'chef de projet digital'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
