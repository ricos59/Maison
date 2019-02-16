<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                'label' => 'Titre'
            ))
            ->add('date', DateType::class, array(
                'required' => true,
                'widget' => 'single_text',
                'format'=> 'yyyy-MM-dd HH:mm:ss',
                'attr' => [
                    'class' => 'datetimepicker-input',
                    'data-provide' => 'datetimepicker',
                    'data-toggle' => "datetimepicker",
                    'data-target' => "#task_date",
                    'html5' => false,
                    'autocomplete' => 'off',
                ],
                // 'constraints' => [new DateTime()],
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
