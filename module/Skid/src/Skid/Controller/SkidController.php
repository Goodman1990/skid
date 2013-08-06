<?php

namespace Skid\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\EventManager\EventInterface as Event;
use Zend\EventManager\EventManager;


class SkidController extends AbstractActionController
{


    public function __construct()
    {
        $events = new EventManager();
        $d = $events->trigger('do');
        print_r($d);
        exit;

    }


    public function indexAction() {


    }
}