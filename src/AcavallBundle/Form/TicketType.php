<?php

namespace AcavallBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class TicketType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('price', HiddenType::class, array(
          'data'=>'Precio',
        ))
        ->add('gender', ChoiceType::class, array(
          'choices' => array(
            ' '=> 'nada',
            'Niño' => 'niño',
            'Adulto'=> 'adulto'
          ),
          "attr"=>['onchange'=>'nuevoCampo()',
                  'class'=>'form_control',
                  'id'=>'inputState'],
          'choice_attr' => [
            'niño' => ['id'=>'niño',],
            'nada'=>['disabled'=>true],
            'adulto'=>['id'=>'adulto'],
          ],
        ))
        ->add('childage', ChoiceType::class, array(
          'choices' => array(
            '1-3' => '1-3',
            '4-6' => '4-6',
            '7-9' => '7-9',
            '10-12' => '10-12',
            '13-15' => '13-15',
            '16-17' => '16-17'
          ),
        ))
        ->add('disability', ChoiceType::class, array(
          'choices' => array(
            ' '=> 'nada',
            'Si'=> false,
            'No'=>true,
          ),
          'choice_attr' => [
            'nada'=>['disabled'=>true],
          ],
        ))
        ->add('enviar',SubmitType::class);
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AcavallBundle\Entity\Ticket'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'acavallbundle_ticket';
    }


}
