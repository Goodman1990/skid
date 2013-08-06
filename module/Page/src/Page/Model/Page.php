<?php
namespace Page\Model;
 
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Page\Form\CustomValidator;
use Zend\View\Model\ViewModel;

class Page
{
    public $vm;
    public $classes;
    public $title;
    public $sub_title;
    public $css;
    public $js;
    public $top_menu;
    public $content;

    public function setClasses($classes){
        $this->classes = $classes;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function setTopMenu($menu){
        $this->top_menu = $menu;
    }

    public function setSubTitle($sub_title){
        $this->sub_title = $sub_title;
    }

    public function setCss($css){
        $this->css = $css;
    }

    public function setJs($js){
        $this->js = $js;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function renderHeader(){
        // $temp = new ViewModel(array());
        // $temp->render('header');
        
    }

    public function renderFooter(){
        
    }

}
