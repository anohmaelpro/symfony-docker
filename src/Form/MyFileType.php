<?php

namespace App\Form;

use App\Entity\Files;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class MyFileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('file', FileType::class)
	       ->add('save', SubmitType::class)
	       ->add('reset', ResetType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Files::class,
		   
	        // enable/disable CSRF protection for this form
	        'csrf_protection' => true,
		   
	        // the name of the hidden HTML field that stores the token
	        'csrf_field_name' => '_token',
	        
	        // an arbitrary string used to generate the value of the token
	        // using a different string for each form improves its security
	        'csrf_token_id'   => 'task_item',
        ]);
    }
}