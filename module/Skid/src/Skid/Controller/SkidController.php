<?php

namespace Skid\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Skid\Controller\CategoryController;
//use Zend\EventManager\EventInterface as Event;
//use Zend\EventManager\EventManager;
use Skid\Model\discountsModel;


class SkidController extends AbstractActionController
{

    public function indexAction() {

//       print_r();
//        exit;
        $discountsModel =   $this->getLocator('discountsModel');
        $discountsModel->getDiscounts();

    }

    protected  function getLocator($Model){

       $sm =  $this->getServiceLocator();
       $discountsModel =  $sm->get($Model);
        return $discountsModel;

    }

}