<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeContrat', ChoiceType::class, [
                'choices' => [
                    'CDD' => 'CDD', 
                    'CDI' => 'CDI', 
                    'Stage été' => 'Stage été', 
                    'Stage PFE' => 'Stage PFE', 
                    'Alternance' => 'Alternance',
                    'Apprentissage' => 'Apprentissage',
                ], 
            ])
            ->add('typeJob', ChoiceType::class, [
                'choices' => [
                    'Agriculture' => 'Agriculture', 
                    'Arts and Multimedia' => 'Arts and Multimedia', 
                    'Education' => 'Education', 
                    'Government and Public Administration' => 'Government and Public Administration', 
                    'Tourism' => 'Tourism', 
                    'IT' => 'IT', 
                    'Manufacturing' => 'Manufacturing', 
                    'Science, Technology, Engineering and Mathematics' => 'Science, Technology, Engineering and Mathematics', 
                    'Finance' => 'Finance', 
                    'Health Science' => 'Health Science', 
                    'Marketing' => 'Marketing', 
                    'Law' => 'Law',
                    'Logistics' => 'Logistics', 
                ], 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
