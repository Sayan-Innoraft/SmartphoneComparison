<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\Smartphone;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type to take smartphone details from user.
 */
class SmartphoneType extends AbstractType {
  public function buildForm(FormBuilderInterface $builder, array $options):void {
    $builder
      ->add('name', TextType::class)
      ->add('brand', TextType::class)
      ->add('frontCamera',NumberType::class)
      ->add('backCamera',NumberType::class)
      ->add('batteryCapacity', NumberType::class)
      ->add('price', NumberType::class)
      ->add('save', SubmitType::class);
  }

  public function configureOptions(OptionsResolver $resolver):void {
    $resolver->setDefaults([
      'data_class' => Smartphone::class,
    ]);
  }

}
