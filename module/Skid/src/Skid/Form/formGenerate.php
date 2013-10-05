<?php


namespace Skid\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class formGenerate extends Form {



    protected $inputFilter;
    protected $factorys;
    protected $inData;
    protected $key;
    protected $message;
    protected $pattern;
    protected $value;
    protected $min;
    protected $max;
    protected $element;
    protected $typeLabel;



    public function __construct($name,$classForm,$dataForm,$typeLabel = null) {

        parent::__construct($name);
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data');
        $this->setAttribute('class', $classForm);
        $this->inputFilter = new InputFilter();
        $this->factorys = new InputFactory();
        $this->inData = $dataForm;

        if($typeLabel){

            $this->typeLabel = $typeLabel;
        }

        foreach ($this->inData as $key => $value) {

            $this->key = $key;
            $this->value = $value;
            $this->setForm();
            $this->add($this->element);
//            echo $this->label;
//            exit;
        }

        $this->setInputFilter($this->inputFilter);
    }

    public function __get($name) {

        if(method_exists($this, ($method = 'get_' . $name))) {

            return $this->$method();

        } else {
            return false;
        }
    }


    public function __set($name, $data) {

        if(method_exists($this, ($method = $name))) {

            foreach ($data as $key => $Value) {
                $this->$key = $Value;
            }

            $data = $this->$method();

            return $data;
        }

        return false;

    }

    protected function setForm() {


        //if(isset($this->value['validators']['regex'])) {
//            echo 123;
//            exit;
//
            $this->getRegexParam();

       // }
       // if(isset($this->value['validators']['length'])) {

            $this->getLengthParam();

      //  }


        $this->getLabelParam();
        $dataValidators = $this->collectionValidators();
        $dataFilters = $this->collectionFilters();

        $this->getInput();
//
//        echo '<pre>';
//        print_r(array(
//                    'name' => 'surname',
//                    'required' => true,
//                    'filters' => array(
//                        array('name' => 'StripTags'),
//                        array('name' => 'StringTrim'),
//                    ),
//                    'validators' => array(
//                        array(
//                            'name' => 'StringLength',
//                            'options' => array(
//                                'encoding' => 'UTF-8',
//                                'min'=>3,
//                                'max' => 30,
//                            ),
//                        ),
//                        array('name' => 'Regex',
//                            'options' => array(
//                                'message'=>'Разрешенные cимволы: буквы русского и латинского алфавитов',
//                                'pattern' => '/^[a-zа-яA-ZА-ЯЁё]+$/u'
//                            ),
//                        ),
//                    ),
//                ));
//        echo '</pre>';
//        exit;

        $this->inputFilter->add(
            $this->factorys->createInput(
                array(
                    'name' => $this->key,
                    'required' => isset($this->value['required']) ? $this->value['required'] : false,
                    'filters'=>$dataFilters,
                    'validators' => $dataValidators
                )
            )
        );
    //        echo '<pre>';
    //        print_r(array(
    //                    'name' => $this->key,
    //                    'required' => isset($this->value['required']) ? $this->value['required'] : false,
    //                    'filters'=>$dataFilters,
    //                    'validators' => $dataValidators
    //                ));
    //        echo '</pre>';
    //        exit;






    }

    protected function collectionValidators() {


        $validate = array(
            'validators' => array(

                'email' => array(
                    'name' => 'EmailAddress',
                    'options' => array(
                        'message' => 'Вы ввели некорректный адрес E-mail.',
                        'encoding' => 'UTF-8',
                    ),
                ),
               'length' => array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => $this->min,
                        'max' => $this->max,
                    ),
                ),
                'Identical' => array(
                    'name' => 'Identical',
                    'options' => array(
                        'message' => 'Пароли не совпадают.',
                        'token' => $this->value['validators']['Identical'],
                    ),
                ),
                'regex' => array(
                    'name' => 'Regex',
                    'options' => array(
                        'message' => $this->message,
                        'pattern' => $this->pattern
                    ),
                ),
//                 'uri'=> array(
//                    'name' => 'Uri',
//
//
//                ),
            ),
        );
        if((!isset($this->value['validators']))&&($this->value['validators']!==false)) {
//
            $dataValidators = array();
            $dataValidators[] = $validate['validators'][$this->key];
            return $dataValidators;

        } else {

            if(!$this->value['validators']){

                return array();

            }

            $dataValidators = array();
//            echo 123;
//            exit;
            foreach ($this->value['validators'] as $key => $value) {

                if(is_numeric($key)){

                    $dataValidators[] = $validate['validators'][$value];

                }else{

                    $dataValidators[] = $validate['validators'][$key];

                }


            }

            return $dataValidators;

        }


    }

    protected function collectionFilters() {

        $filters = array(

               'tag'=> array( 'name' => 'StripTags' ),
               'trim'=> array( 'name' => 'StringTrim' ),
               'int'=>  array('name' => 'Int'),

        );
        if((!isset($this->value['filters']))) {

            $filtersDefault = array(

                 array( 'name' => 'StripTags' ),
                 array( 'name' => 'StringTrim' ),

            );

            return $filtersDefault;

        } else {

            $dataFilters = array();

            foreach ($this->value['filters'] as $key => $value) {

                $dataFilters[] = $filters[$value];

            }

            return $dataFilters;

        }


    }

    protected function getInput() {
//
        if($this->value['typeInput'] == 'radio') {

            $this->getRadioParam();

        } else  if($this->value['typeInput'] == 'checkbox') {

           $this->getCheckboxParam();

        } else if ($this->value['typeInput'] == 'textarea') {

            $this->getTextareaParam();

        }else if($this->value['typeInput'] == 'select') {

            $this->getSelectParam();

        } else {

                $this->element = array(
                    'name' => $this->key,
                    'type' => isset($this->value['typeInput']) ? $this->value['typeInput'] : 'text',
                    'attributes' => array(
                        'id' => $this->value['id'],
                        'placeholder' =>$this->value['placeholder']
                    ),
                    'options' => array(
                        'label' =>$this->label?$this->label:''
                    ),
                );


            }



    }

    protected function getRegexParam() {

        $regex = array(

            'message' => array(
                'title' => 'Разрешенные cимволы: буквы русского и латинского алфавитов, и цифры знаки:  "\',.?!$%-_()    ',
                'discount' => 'Разрешенные cимволы: цифры',
                'russian' => 'Разрешенные cимволы: буквы русского алфавита',
                'phone' => 'Разрешенные cимволы: цифры',
                'date'=>'Разрешенные cимволы: цифры и знак "/"'
            ),
            'pattern' => array(
                'title' => '/^[0-9a-zA-Zа-яA-ZА-ЯЁё\,\.?!\(\)\"\'\%\-\_]+$/u',
                'discount' => '/^[a-zA-Z0-9\.,\-_]+$/u',
                'russian' => '/^[а-яA-ЯЁё]+$/u',
                'isq' => '/^[0-9]+$/u',
                'date' => '/^[0-9\/: ]+$/u'
            )
        );

            $this->message = $regex['message'][$this->value['validators']['regex']];
            $this->pattern = $regex['pattern'][$this->value['validators']['regex']];
    }

    protected function getLengthParam() {

        $length = array(



            'name' => array(3,20),
            'titleCourse'=>array(2,70),
            'password'=>array(6,20),
            'isq' => array( 6, 11 ),
            'skype' => array( 3, 255 ),
            'phone' => array( 6, 20 ),
            'note'=>array(2,255)

        );
//        echo ;
//        exit;
        if(isset($this->value['validators']['length'])){
//            echo 123;
//            exit;

            if(is_array(($this->value['validators']['length']))){

                $this->min = $this->value['validators']['length'][0];

                $this->max =  $this->value['validators']['length'][1];

            }else{

                $this->min = $length[$this->value['validators']['length']][0];

                $this->max =  $length[$this->value['validators']['length']][1];

            }


//            echo  $this->value['validators']['length'];
//            exit;

        }else{

             $this->min = $length[$this->key][0];
//            exit;
            $this->max = $length[$this->key][1];
        }
    }

    protected function getRadioParam() {

        $radio = array(
            'addLesson' => array(
                '0' => 'вставить в начало списка',
                '1' => 'вставить в конец списка',
                '2' => 'вставить после урока'
            ),
            'addLessonHidden' => array(
                '0' => 'считать новым для всех. Для всех учеников этот урок считать новым и не пройденным.',
                '1' => 'внедрить незаметно. Для учеников, у которых номер текущего урока больше чем номер нового урока, считать пройденным'
            ),
            'addTraining' => array(
                '0' => 'Только после проверки ДЗ ',
                '1' => 'Сразу после отправки ДЗ на проверку',
                //'2' => 'Новое дз открывается раз в сутки, независимо от проверки'
            ),
            'sendMessage'=>array(

                'all' => 'отправить письмо всем',
                'active' => 'отправить письмо только активным пользователям',
                'noActive' => 'отправить письмо только не активным пользователям'

            )
        );

        $this->element = new Element\Radio($this->key);
        $this->element->setValueOptions($radio[$this->value['typeRadio']]);
        $this->element->setValue($this->value['value']);


        //$this->add($element);

    }

    protected function getCheckboxParam() {

        $this->element = new  Element\Checkbox($this->key, array(
            'label' => $this->label,

        ));


        //$this->add($element);

    }

    protected function getTextareaParam() {
//        echo $this->value['class'];
//        exit;
        $this->element = new Element\Textarea($this->key, array(
                                        'label' =>$this->label,
                                    )
        );
        if(isset($this->value['class'])){
            $this->element->setAttribute('class',$this->value['class']);
        }


    }
    protected function getSelectParam() {
//        echo $this->value['class'];
//        exit;
        $select = array(
            'city' => array(
                '0' => 'Донецк',
                '1' => 'Харьков',
                '2' => 'Днепропетровск'
            ),
            'category' => array(
                '0' => 'Донецк',
                '1' => 'Харьков',
                '2' => 'Днепропетровск'
            )

        );


        $this->element =  new Element\Select($this->key);
        $this->element->setLabel($this->label);
        $this->element->setValueOptions($select[$this->value['typeSelect']]);
        if(isset($this->value['class'])){
            $this->element->setAttribute('class',$this->value['class']);
        }
    }


    protected function getLabelParam() {

        $label= array(
            'add_discounts' => array(
                'title[]' => 'Напишите  заголовок'  ,
                'description_short[]' => 'Напишите краткое описание акции(скидки)',
                'description_full[]' => 'Напишите полное описание скидки',
                'date_begin[]' => 'Дата начала акции',
                'date_end[]' => 'Дата окончания акции',
                'discount[]' => 'Дата окончания акции',
                'image_short[]' => 'загрузка изображений для слайдера',
                'image_full[]' => 'загрузка изображений для старници акции',
                'city[]'=>'выберете город',
                'category[]'=>'выберете категорию'
               
            ),


        );

        if(isset($this->value['setLabel'])){

                $this->label = $this->value['setLabel'];
        }else{

                $this->label = $label[$this->typeLabel][$this->key];
        }



        //$this->add($element);

    }
  public function   checkValidation($data){
        $flag  = true;
        foreach($data as $key=>$value){

            switch($key){

                case'email';
                    for($i=0;$i<count($data['email']);$i++){
                        $flag =   preg_match('/^[^\W][a-zA-Z0-9\_\.\-]+(\.[a-zA-Z0-9\_\-\.]+)*\@[a-zA-Z0-9_\-\.]+(\.[a-zA-Z0-9\_\.\-]+)*\.[a-zA-Z\-\.\_]{2,4}$/',$data['email'][$i]);
//                        echo $data['email'][$i].' <br />';
                    }
                    break;
                case'name';
                    for($i=0;$i<count($data['name']);$i++){
                        $flag =   preg_match('/^[a-zA-Zа-яA-ZА-ЯЁё\-]+$/u',$data['name'][$i]);
                    }
                    break;
                case'surname';
                    for($i=0;$i<count($data['name']);$i++){
                        $flag =   preg_match('/^[a-zA-Zа-яA-ZА-ЯЁё\-]+$/u',$data['name'][$i]);
                    }
                    break;

            }

        }
        return $flag;
//      if (preg_match('/^[^\W][a-zA-Z0-9\_\.\-]+(\.[a-zA-Z0-9\_\-\.]+)*\@[a-zA-Z0-9_\-\.]+(\.[a-zA-Z0-9\_\.\-]+)*\.[a-zA-Z\-\.\_]{2,4}$/', $this->email)){
////            echo 123;
////            exit;
//
//
////            }else{  }
//      }else{return false;}

  }


}