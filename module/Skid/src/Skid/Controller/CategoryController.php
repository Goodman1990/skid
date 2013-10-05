<?php


namespace Skid\Controller;


use Zend\Mvc\Controller\AbstractActionController;

class CategoryController extends AbstractActionController {

    public function getServiss(){
        echo 123;
        exit;
        $sm = $this->getServiceLocator();

        return $sm;
    }

}