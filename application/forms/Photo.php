<?php

class Form_Photo extends Zend_Form {
	
    public function init() {
    	
    	$this->setAttrib('enctype', 'multipart/form-data');
    	$this->setMethod('post');
    	
        $photo = new Zend_Form_Element_File('photo');
        $photo->setLabel('个人头像  :')
        		->addValidator('Count', false, 1)
        		->addValidator('Extension', false, 'jpg','png','gif','jpeg')
        		->addValidator(new Zend_Validate_File_ImageSize(array(
        				'minheight' => 150, 'minwidth' => 150,
        				'maxheight' =>200, 'maxwidth' =>200)))
        		->addValidator('Size',false, array('max' =>'300Kb'))
        		->addErrorMessage('最大300KB，最小尺寸150X150px,最大尺寸200X200px');
        	//	->removeDecorator('DtDdWrapper')
        	//	->removeDecorator('HtmlTag');
        	 //	->removeDecorator('Label');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'new_btn')
            ->setLabel('提交')
          	->removeDecorator('HtmlTag')
           ->removeDecorator('Label')
           ->removeDecorator('DtDdWrapper');
        
        $this->addElements(array($photo, $submit));
        
    }
}
