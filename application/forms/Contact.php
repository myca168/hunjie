<?php

class Form_Contact extends Zend_Form {
	
    public function init() {
            
        $tel = new Zend_Form_Element_Text('tel');
        $tel->setLabel('电话 : ')
            ->setAttrib('size', '30')
     //       ->addFilter('StringTrim') no working in utf8
            ->removeDecorator('HtmlTag');
            
        $fax = new Zend_Form_Element_Text('fax');
        $fax->setLabel('传真 : ')
            ->setAttrib('size', '30')
            ->removeDecorator('HtmlTag');
        
        $site = new Zend_Form_Element_Text('site');
        $site->setLabel('网站 :')
            ->setAttrib('size', '50')
            ->removeDecorator('HtmlTag')
            ->addDecorator('HtmlTag', array('tag'=>'br','placement'=>'append'));
         
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'new_btn')
            	->setLabel('更新')
            	//->addDecorator('HtmlTag', array('tag'=>'br','closeOnly'=>false,'placement'=>'prepend')) 
            	->removeDecorator('DtDdWrapper');
        
        $this->addElements(array($tel,$fax,$site,$submit));
        
	    }
}
