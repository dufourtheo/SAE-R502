<?php

namespace App\Form;

use Symfony\Component\Form\FormBuilderInterface;

class AddChallengeTypeFormType extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options) : variant_mod
    {
        $builder
        ->add('selectedImage', TextType::class, [
            'label' => 'Sélectionner une image :',
            'required' => false,
        ]);


    }

}
