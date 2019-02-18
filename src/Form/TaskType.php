<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Nom de la tâche'])
            ->add('date', DateType::class, ['label' => 'Prochaine date d\'echéance'])
            ->add('comments', TextareaType::class, ['label' => 'Notes'])
            ->add('frequency_choice', ChoiceType::class, [
              'label' => 'Répéter la fréquence',
              'choices' => [
                'jour' => 'jour',
                'mois' => 'mois',
                'année' => 'année',
              ],
            ])
            ->add('frequency', IntegerType::class, ['label' => 'Répétition'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
