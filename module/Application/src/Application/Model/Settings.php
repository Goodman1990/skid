<?php

namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\ServiceManager\ServiceManager;

class Settings{
    protected $adapter;

    public function __construct()
    {
    	$sm = new ServiceManager;
    	//$this->$adapter = $sm->get('Zend\Db\Adapter\Adapter');
    	//$sm = $this->getServiceLocator();
        //$this->adapter = new Adapter(null);
    }

    public function setAdapter(Adapter $adapter){
    	$this->adapter = $adapter;
    }

    public function getTheme(){
    	if($this->adapter instanceof Adapter){
	    	$resultSet = $this->adapter->createStatement('SELECT * FROM skid');
	        $results = $resultSet->execute();
	        echo '<pre>';
	        //$results->next();
	        print_r($results->next());
	        echo '</pre>';
	        exit;
	    }
    }
}