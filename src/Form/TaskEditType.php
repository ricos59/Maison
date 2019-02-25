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
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class TaskEditType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
    ->add('title', TextType::class, ['label' => 'Nom de la tâche'])
    ->add('date', DateType::class, ['label' => 'Prochaine date d\'echéance'])
    ->add('comments', TextareaType::class, ['label' => 'Notes', 'required'   => false])
    ->add('frequency_choice', ChoiceType::class, [
      'label' => 'Répéter la fréquence',
      'choices' => [
        'Choisir une date' => NULL,
        'jour' => 'jour',
        'mois' => 'mois',
        'année' => 'année',
      ],
    ])
    ->add('frequency', IntegerType::class, ['label' => 'Répétition', 'required'   => false])

    ->add('users', null, [
        'required' => true,
      ] )
      ->add('validated', CheckboxType::class, ['label' => 'Effectuer', 'required'   => false])
      ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefaults([
        'data_class' => Task::class,
      ]);
    }
  }
