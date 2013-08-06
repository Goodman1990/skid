<?php
/**
 * Created by JetBrains PhpStorm.
 * User: artgen2
 * Date: 06.08.13
 * Time: 17:01
 * To change this template use File | Settings | File Templates.
 */

namespace Skid\Model;

use Zend\Db\Adapter\Adapter;

class discountsModel {


    public function __get($name){

        if (method_exists($this, ($method = 'get_'.$name))){

            return $this->$method();

        }else return;
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

    public function __construct(Adapter $adapter)
    {

        $this->adapter = $adapter;
        $this->sql = new \Zend\Db\Sql\Sql($adapter);

    }

}