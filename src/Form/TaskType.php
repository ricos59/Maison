<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                'label' => 'Nom de la tâche'
            ))
            ->add('date', DateTimeType::class, array(
                'label' => 'Prochaine date d\'échéance',
                'required' => true,
                'widget' => 'single_text',
                // 'format'=> 'yyyy-MM-DD HH:mm:ss',
                'format' => 'dd-MM-yyyy HH:mm:ss',
                'attr' => [
                    'class' => 'datetimepicker datetimepicker-input',
                    'data-provide'  => 'datetimepicker',
                    'data-toggle'   => "datetimepicker",
                    'data-target'   => "#task_date",
                    'data-date-format' => "DD-MM-YYYY HH:mm:ss",
                    'html5'         => false,
                    'autocomplete'  => 'off',
                ],
            ))
            ->add('frequency_choice', ChoiceType::class, array(
                'label' => 'Répéter la fréquence',
                'choices' => array(
                    'jour'      => 1,
                    'mois'      => 2,
                    'semaine'   => 3,
                    'année'     => 4,
                )
                ))
            ->add('frequency_int', IntegerType::class,array( // frquency_period
                'label' => '..'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
