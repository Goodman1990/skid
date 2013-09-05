<?php

namespace Skid\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Skid\Controller\CategoryController;
use Skid\Form\uploadForm;

//use Zend\EventManager\EventInterface as Event;
//use Zend\EventManager\EventManager;
use Skid\Model\discountsModel;


class SkidController extends AbstractActionController {


    protected $hashMap = array(

        'model' => array(

            'dis' => 'discountsModel',
            'cat'=>'categoryModel'


        )
    );
    protected $id;//id - скидки
    protected $idUser;
    protected $idCity;
    protected $idCategory;


    protected function getLocator($Model, $param = array(), $action = null) {

//        echo $this->hashMap['model'][$Model];
//        exit;
        $sm = $this->getServiceLocator();
        $model = $sm->get($this->hashMap['model'][$Model]);

        if(($action) && ($param)) {

            $model->$action($param);

        } elseif($param) {

            $model->setParam($param);

        }

        return $model;

    }


   protected  function  init(){

    $this->id = $this->params()->fromRoute('id_city', 0);

   }




    public function indexAction() {

    $this->init();

        if(!empty($this->idCity)){

            $discounts = $this->getLocator('dis', array(
                'id' => $this->idCity
            ));

            $data = $discounts->getDiscountsById();


        }else{
//            echo 123;
//            exit;
            $discounts = $this->getLocator('dis');
            $data = $discounts->getAllDiscounts();

        }

        return array(
            'dataDiscounts'=>$data
        );


    }


    public function categoryAction(){



    }




//    public function uploadAction() {
//
//        $form = new addTrainingForm('create-training');
//
//        $request = $this->getRequest();
//
//        if ($request->isPost()) {
//
//            if (($request->getPost('typeEvent') === 'deleted')&&($request->getPost('imageName') !== 'default.png')) {
//
//                $imageName = $request->getPost('imageName');
//                $filename = (__DIR__ . '/../../../../../../public/userData/' . $imageName);
//                unlink($filename);
//                echo 1;
//                exit;
//            }
//            $postArr = $request->getPost()->toArray();
//            $fileArr = $this->params()->fromFiles('file');
//            $formData = array_merge($postArr, array( 'file' => $fileArr['name'] ));
////            print_r($formData);
////            exit;
//            $form->setData($formData);
//
//
//            $adapter = new \Zend\File\Transfer\Adapter\Http();
//            $size = new \Zend\Validator\File\Size(array( 'min' => 1, 'max' => 5242880 ));
//            $extension = new \Zend\Validator\File\Extension(array( 'extension' => array( 'png', 'jpg', 'jpeg' ) ));
//            $filter = new \Zend\Filter\File\Rename(array(
//                                                       "randomize" => true,
//                                                   ));
//
//            $adapter->setValidators(array( $size, $extension ), $fileArr['name']);
//
//            if ($adapter->isValid()) {
//
//                $adapter->setDestination(__DIR__ . '/../../../../../../public/userData/');
//
//                if ($adapter->receive($fileArr['name'])) {
//
//                    $filename = $adapter->getFileName();
//
//                    $filename = $filter->filter($filename);
//
//                    $heightScreen = (int) $formData['width'];
//                    $widthScreen = (int) $formData['height'];
//
//                    list($width, $height, $type, $attr) = getimagesize($filename);
//
//
//                    if (($width < 320) || ($height < 320)) {
//
//                        echo 'error';
//                        exit;
//
//                    }
//
//
//                    $flag = false;
//
//                    if (($heightScreen < $height) || ($widthScreen < $width)) {
//
//                        $flag = 1;
//                        while (1) {
//
//                            $n1 = $width / $height;
//                            $n2 = $height / $width;
//
//                            if ($n1 > 1) {
//
//                                $cof = $n1;
//
//                            } else {
//
//                                $cof = $n2;
//
//                            }
//
//                            if (($heightScreen < $height) || ($widthScreen < $width)) {
//
//                                $width = $width / $cof;
//                                $height = $height / $cof;
//
//                            } else {
//
//                                break;
//                            }
//                        }
//                    }
//
//                    if ($flag) {
//
//                        $imageResize = new SimpleImage();
//                        $imageResize->load($filename);
//                        $imageResize->resize($width, $height);
//                        $imageResize->save($filename);
//
//                    }
//                    $data[0]['image'] = basename($filename);
//                    $data[0]['imageHight'] = $width;
//                    $data[0]['imageWidth'] = $height;
//                    $data = $this->encodeUtf8($data);
//                    echo $data;
//                    exit;
//                }
//            }
//
//
//        echo 'error';
//        exit;
//        }
//
//    }

}