<?php

class Form_Extend extends Zend_Form {
	
    public function init() {
    	
    	$month = new Zend_Form_Element_Select('ads');
    	$month->setMultiOptions(Model_Rate::getAll())
        	->setLabel('请选择  : ')
        	 ->setAttrib('class', 'month')
        	 ->setRequired(true)
            ->removeDecorator('DtDdWrapper')
            	->removeDecorator('HtmlTag')
            	 ->removeDecorator('Label')
            	 ->removeDecorator('Errors');
            
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'extend')
            	->setLabel('提交')
            	->removeDecorator('DtDdWrapper')
            	->removeDecorator('HtmlTag')
            	 ->removeDecorator('Label')
            	 ->removeDecorator('Errors');
        
        $this->addElements(array($month,$submit));
        
	    }
}
