<?php

namespace Skid\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class uploadForm extends Form
{
   
    public function __construct($name = "upload")
    {
        // we want to ignore the name passed
        parent::__construct($name);
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data');
        $this->setAttribute('class', 'standart grouped');
        
        
        
        
        
         $this->add(array(
            'name' => 'file',
            'type' => 'file',
            'required' => false,
            'options' => array(
            'label' => 'Загрузите картинку, которая будет символизировать тренинг',
            ),
        ));
         
                
    }

    
}

