<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('username')
            ->add('job', ChoiceTYpe::class, [
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
            ->add('etablissment', ChoiceType::class, [
                'choices' => [
                   'Institut supérieur des arts multimédia de La Manouba' => 'Institut supérieur des arts multimédia de La Manouba', 
                   'École nationale des sciences de l\'informatique' => 'École nationale des sciences de l\'informatique', 
                   'Institut supérieur de comptabilité et d\'administration des entreprises' => 'Institut supérieur de comptabilité et d\'administration des entreprises',
                   'École nationale d\'architecture et d\'urbanisme de Tunis' => 'École nationale d\'architecture et d\'urbanisme de Tunis', 
                   'Institut supérieur de gestion de Bizerte' => 'Institut supérieur de gestion de Bizerte', 
                   'École polytechnique de Tunisie' => 'École polytechnique de Tunisie', 
                   'École nationale d\'ingénieurs de Carthage' => 'École nationale d\'ingénieurs de Carthage', 
                   'École nationale d\'ingénieurs de Bizerte' => 'École nationale d\'ingénieurs de Bizerte', 
                   'Institut supérieur des technologies de l\'information et de la communication de Borj Cédria' => 'Institut supérieur des technologies de l\'information et de la communication de Borj Cédria'
                ]
            ] )
            ->add('diplome', ChoiceType::class, [
                'choices' => [
                    'Diplôme Nationale d\'ingénieurs' => 'Diplôme Nationale d\'ingénieurs', 
                    'Licence' => 'Licence', 
                    'Mastère' => 'Mastère'
                ]
            ])
            ->add('experience')
            ->add('dateNaissance')
            ->add('phone')
            ->add('skills')
            ->add('work')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
