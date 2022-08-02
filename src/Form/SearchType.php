<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchType extends AbstractType
{
    /** {@inheritDoc} */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('term', TextType::class, ['required' => false, 'label' => false]);
    }
}
