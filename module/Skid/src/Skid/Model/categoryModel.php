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

class categoryModel {

    protected  $adapter;
    protected  $sql;
    protected  $table;
    protected  $id;



//    public function __get($name){
//
//        if (method_exists($this, ($method = 'get_'.$name))){
//
//            return $this->$method();
//
//        }else return false;
//    }

    public function __set($name, $data){
//            print_r($data);
//        exit;


            foreach($data  as $key =>$Value){

                $this->$key = $Value ;

            }
            echo $this->table;
            exit;



    }

    public function __construct(Adapter $adapter)
    {

        $this->adapter = $adapter;
        $this->sql = new \Zend\Db\Sql\Sql($adapter);
        $this->table = 'category';


    }


    public  function categoryInCity(){

            $select =$this->sql->select();

            $select->from($this->table);

            $select->where(array('id' => $this->id));
            $statement = $this->sql->prepareStatementForSqlObject($select);
            $results = $statement->execute();
            $data=array();

            foreach ($results as $result){


                $data[]=$result;

            }

            return $data;


    }

    public  function getDiscountsInCategory(){



        $select =$this->sql->select();

        $select->from($this->table);

        $select->where(array('id' => $this->id));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        $data=array();

        foreach ($results as $result){


            $data[]=$result;

        }

        return $data;


    }
    public  function getAllDiscounts(){



        $select =$this->sql->select();

        $select->from($this->table);

        $select->where(1);
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        $data=array();

        foreach ($results as $result){


            $data[]=$result;

        }

        return $data;


    }



    public  function  setParam($data){

        foreach($data  as $key =>$Value){
            $this->$key = $Value ;
        }
        return 1;

    }

}