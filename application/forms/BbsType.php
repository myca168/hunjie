<?php

class Form_BbsType extends Zend_Form {
	
    public function init() {
    	
    	$this->setAttrib('enctype', 'multipart/form-data');
    	$this->setMethod('post');
    	
    	$name = new Zend_Form_Element_Text('name');
        $name->setLabel('BBS Type : ')
            ->setAttrib('size', '30')
            ->setAttrib('maxlength',60)
            ->setRequired(true)
            ->removeDecorator('HtmlTag');
 
        
        $desc = new Zend_Form_Element_Text('desc');
        $desc->setLabel('Descriptions : ')
            ->setAttrib('size', '60')
            ->setAttrib('maxlength',100)
             ->setRequired(true)
            ->removeDecorator('HtmlTag');
            
        $access = new Zend_Form_Element_Select('access');
        $access->setMultiOptions(array(Model_BbsType::ACCESS_YES=>"Allowed",Model_BbsType::ACCESS_NO=>"No Allowed"))
        	->setLabel('Allowed for All : ')
        	 ->setRequired(true)
            ->addFilter('StringTrim')
          //   ->removeDecorator('Label')
            ->removeDecorator('HtmlTag');
            
        $status = new Zend_Form_Element_Select('status');
        $status->setMultiOptions(array(Model_BbsType::STATUS_ACTIVE=>"Active",Model_BbsType::STATUS_INACTIVE=>"Inactive"))
        	->setLabel('Status : ')
        	 ->setRequired(true)
            ->addFilter('StringTrim')
          //   ->removeDecorator('Label')
            ->removeDecorator('HtmlTag');
            
        $sqn = new Zend_Form_Element_Text('sqn');
        $sqn->setLabel('Order : ')
        	 ->addValidator('Between',false, array(0,99)) 
        	 ->setRequired(true)
        	 ->setAttrib('size', '3')
        	 ->addValidator('Int') 
            ->addFilter('StringTrim')
             ->removeDecorator('HtmlTag');
            
        $logo = new Zend_Form_Element_File('logo');
        $logo->setLabel('Image (Max : 300kb) : ')
        		->addValidator('Count', false, 1)
        		->addValidator('Extension',false,'jpg,png,gif,jpeg')
        	//	->addValidator('ImageSize',array(50,70,60,100)) 
        		->addValidator('Size',false, array('max' =>'300Kb'))
        		->removeDecorator('DtDdWrapper')
        		->removeDecorator('HtmlTag');
            
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'new_custmer')
            	->setLabel('Submit');
            //	->removeDecorator('DtDdWrapper');
        
        $this->addElements(array($name,$desc,$access,$status,$sqn,$logo,$submit));
        
	    }
}
