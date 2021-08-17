<?php


namespace App\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class DiagnosisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'diagnosisDateTime',
                DateTimeType::class,
                [
                    'input' => 'datetime_immutable',
                    'widget' => 'single_text',
                    'attr' => [
                        'step' => 900,
                        'min' => (new \DateTimeImmutable())->format('Y-m-d H:i:s')
                    ]
                ]
            )
            ->add('petName', TextType::class)
            ->add('ownerName', TextType::class)
            ->add('contactNumber', TextType::class)
            ->add('severity', ChoiceType::class,[
                'choices' => [
                    'Severe' => 'SEVERE',
                    'High' => 'HIGH',
                    'Normal' => 'NORMAL',
                    'Low' => 'LOW',
                ]
            ])
            ->add('notes', TextType::class)

            ->add('allergies', ChoiceType::class, [
                'choices' => [
                    'Meat' => 'meat',
                    'Diary' => 'diary',
                    'Nuts' => 'nuts',
                    'Vegetables' => 'vegetables',
                ],
                'multiple' => true
            ])
            ->add('submit', SubmitType::class);
    }
}