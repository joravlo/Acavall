<?php

namespace AcavallBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class)
        ->add('description', TextType::class)
        ->add('address', TextType::class)
        ->add('capacity', TextType::class)
        ->add('date', DateType::class, array('widget' => 'choice'))
        ->add('price', TextType::class, array('label' => 'Precio de la entrada'))
        ->add('video', TextType::class)
        ->add('image', TextType::class)
        ->add('categories')
        ->add('Crear evento',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AcavallBundle\Entity\Event'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'acavallbundle_event';
    }


}
