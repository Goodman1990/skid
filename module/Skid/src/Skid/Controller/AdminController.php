<?php

namespace Skid\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Skid\Form\formGenerate;


class AdminController extends AbstractActionController {

    public function __construct(){


    }

    public function __get($name){

        if (method_exists($this, ($method = 'get_'.$name))){

            return $this->$method();

        }else return false;
    }

    public function __set($name, $data){

        if (method_exists($this, ($method =$name))){

            foreach($data  as $key =>$Value){
                $this->$key = $Value ;
            }
            $data = $this->$method();

            return $data;
        }

    }

    protected function init(){


    }

    public function indexAction(){// add new discounts

        $form = new formGenerate('add_discount','add_discounts',
            array(
                'city[]'=>array('typeInput'=>'select','typeSelect'=>'city','validators'=>array('regex'=>'russian')),
                'category[]'=>array('typeInput'=>'select','typeSelect'=>'category','validators'=>array('regex'=>'russian'),'setLabel'=>'123s'),
                'title[]'=>array('validators'=>array('regex'=>'title'),'required'=>true),
                'description_short[]'=>array('validators'=>array('regex'=>'title'),'typeInput'=>'textarea'),
                'description_full[]'=>array('validators'=>array('regex'=>'title'),'typeInput'=>'textarea'),
                'date_begin[]'=>array('validators'=>array('regex'=>'date')),
                'date_end[]'=>array('validators'=>array('regex'=>'date')),
                'discount[]'=>array('validators'=>array('regex'=>'discount')),
                'image_short[]'=>array('typeInput'=>'file','validators'=>false),
                'image_full[]'=>array('typeInput'=>'file','validators'=>false),



            ),'add_discounts'
        );

        return new ViewModel(
            array(
                'form'=>$form,
            )
        );

    }




}