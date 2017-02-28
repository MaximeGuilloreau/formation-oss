<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class SearchJobType
 */
class SearchJobType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('search', TextType::class)
            ->add('category', EntityType::class, [
                'required' => false,
                'class' => 'AppBundle:Category',
                'choice_label' => 'name',
            ])
            ->add('company', EntityType::class, [
                'required' => false,
                'class' => 'AppBundle:Category',
                'choice_label' => 'name',
            ]);
    }
}
