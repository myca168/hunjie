<?php

class Form_SetOrder extends Zend_Form {
	
    public function init() {

    	$menus=$this->getView()->rows;
    	
    	foreach ($menus as $k=>$menu) {
    		$key=$menu->id;
    	
    		$keyObj = new Zend_Form_Element_Text("$key");
    		$keyObj->setLabel("$menu->name :")
    		->setAttrib('size', '10')
    		->addFilter('StringTrim')
    		->setRequired(true)
    		->addValidator('Int')
    		->setValue($k+1)
    		->removeDecorator('HtmlTag');
    		$this->addElement($keyObj);
    	}
    	$submit = new Zend_Form_Element_Submit('submit');
    	$submit->setAttrib('id', 'new_btn')
    	->setLabel('Submit')
    	->addDecorator('HtmlTag', array('tag'=>'br','closeOnly'=>false,'placement'=>'prepend'))
    	->removeDecorator('DtDdWrapper');
    	
    	$this->addElement($submit);
    	
    	}
  }
