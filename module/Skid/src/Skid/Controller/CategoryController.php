<?php


namespace Skid\Controller;


use Zend\Mvc\Controller\AbstractActionController;

class CategoryController extends AbstractActionController {

    public function getServiss(){

        $sm = $this->getServiceLocator();

        return $sm;
    }

}