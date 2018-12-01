<?php

class Form_Upload extends Zend_Form {
	
    public function init() {
    	
    	$this->setAttrib('enctype', 'multipart/form-data');
    	$this->setMethod('post');
    	
        $image = new Zend_Form_Element_File('image');
        $image->setLabel('Upload Image:')
        		->setRequired(true)
        	//	->setMultiFile(8)
        		->addValidator('Count', false, 1)
        		->addValidator('Extension',false,'jpg,png,gif,jpeg')
        		->removeDecorator('Error')
        		->addValidator('Size',false, array('max' =>'4MB'))
        	//	->removeDecorator('DtDdWrapper')
        		->removeDecorator('HtmlTag');
            
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'new_customer')
            	->setLabel('Submit');
            //	->removeDecorator('DtDdWrapper');
        
        $this->addElements(array($image,$submit));
        
	 }
	    
}
