<?php

class Form_Image extends Zend_Form {
	
    public function init() {
    	
    	$this->setAttrib('enctype', 'multipart/form-data');
    	$this->setMethod('post');
    	
        $photo = new Zend_Form_Element_File('photo');
        $photo->setLabel('图片  :')
        		->addValidator('Count', false, 1)
        		->addValidator('Extension', false, 'jpg','png','gif','jpeg')
 /*       		->addValidator(new Zend_Validate_File_ImageSize(array(
        				'minheight' => 150, 'minwidth' => 150,
        				'maxheight' =>300, 'maxwidth' =>300)))
        		->addValidator('Size',false, array('max' =>'2Mb'))
        		->addErrorMessage('最大2Mb，最小尺寸150X150px,最大尺寸300X300px') */
        	//	->removeDecorator('DtDdWrapper')
        	//	->removeDecorator('HtmlTag')
        	 	->removeDecorator('Label');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'new_btn')
            ->setLabel('提交')
          	->removeDecorator('HtmlTag')
           ->removeDecorator('Label')
           ->removeDecorator('DtDdWrapper');
        
        $this->addElements(array($photo, $submit));
        
    }
}
