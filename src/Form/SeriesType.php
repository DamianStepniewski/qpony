<?php

namespace App\Form;

use App\Validator\Constraints\ContainsMaxTenLines;
use App\Validator\Constraints\ContainsNaturalNumberPerLine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeriesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('inputData', TextareaType::class, [
                'label' => 'Dane',
                'constraints' => [
                    new ContainsMaxTenLines(),
                    new ContainsNaturalNumberPerLine()
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Oblicz'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([

        ]);
    }
}
