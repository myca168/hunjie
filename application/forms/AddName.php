<?php

class Form_AddName extends Zend_Form {
	
    public function init() {
    	
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name : ')
            ->setAttrib('size', '50')
            ->setAttrib('maxlength',80)
            ->setRequired(true)
            ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag');
            
        $submit = new Zend_Form_Element_Submit('Submit');
        
        $this->addElements(array($name,$submit));
        
	    }
}
