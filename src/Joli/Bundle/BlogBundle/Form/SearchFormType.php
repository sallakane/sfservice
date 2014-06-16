<?php

namespace Joli\Bundle\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;



class SearchFormType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        
        $builder
        ->add('search', 'text')
        ->add('is_published', 'checkbox', array('required' => false));
        
    }
    
    
    public function getName()
    {
        return 'blogsearch';
    }
    
}