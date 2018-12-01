<?php

class Form_BbsTopic extends Caclass_Form {
	
    public function init() {
                 
        $title = new Zend_Form_Element_Text('title');
        $title->setLabel('标题 : ')
        	->setAttrib('maxlength',120)
            ->setAttrib('size', '70')
            ->setRequired(true)
             ->addErrorMessage('不能为空 !')
            ->removeDecorator('Label')
           ->removeDecorator('Errors')
           ->removeDecorator('HtmlTag');
        		
        $img = new Zend_Form_Element_File('image');
        $img->setLabel('相关图片 : ')
        //		->addValidator('Count', false, 1)
        		->addValidator('Extension',false,'jpg,png,gif,jpeg')
        		->addValidator('Size',false, array('max' =>'2Mb'))
        		->addErrorMessage('必须是jpg,png,gif,jpeg文件且大小不超过2Mb!')
        		->removeDecorator('DtDdWrapper')
        		 ->removeDecorator('Label')
        	  ->removeDecorator('Errors')
        		->removeDecorator('HtmlTag');
        		
          
        $button = new Zend_Form_Element_Submit('upload');
        $button->setAttrib('id', 'upload_img')
            	->setLabel('上传 ')
            	->removeDecorator('Label')
            	->removeDecorator('DtDdWrapper')
            	 ->removeDecorator('Errors')
        		 ->removeDecorator('HtmlTag');
            
        $content = new Zend_Form_Element_Textarea('editor1');
        $content->setLabel('内容 : ')
        		 ->removeDecorator('Label')
        		 ->setAttrib('maxlength',100000)
        		 ->addValidator('StringLength', false, array(0, 200000))
        		 ->addErrorMessage('不能超过200000字符')
        	 	 ->removeDecorator('Errors')
        		 ->removeDecorator('HtmlTag')
        		 ->removeDecorator('DtDdWrapper');
   	
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'new_custmer')
        		 ->removeDecorator('Label')
        		 ->removeDecorator('HtmlTag')
        		 ->removeDecorator('DtDdWrapper')
            	->setLabel('提交');
        
        $this->addElements(array($title,$img,$button,$content,$submit));
        	 
       }
	    
	 function __toString() 	{

	 	$result = '<form class="topic_fm" enctype="multipart/form-data" method="post" action="">';

		$result .= "<table class='bigform'>";
		
		$result .= '<tr><td class="label_c1 required">标题 : </td><td class="field_c2">' .$this->getElement("title")->__toString().'</td></tr>';
		
		
		$result .= '<tr><td class="label_c1">相关图片 : </td><td class="field_c2">' .$this->getElement("image")->__toString().'</td></tr>';	
		$result .= '<tr><td class="label_c1"></td><td class="field_c2">' .$this->getElement("upload")->__toString()."<span class='alert'>【最多可上传5张图片，每张不超过2Mb】</span><br/><div class='img_box'></div>".'</td></tr>';	
		
		$result .= '<tr><td class="label_c1">内容 : </td><td class="field_c2">' . $this->getElement('editor1').'</td></tr>';
	
		$result .= '<tr><td class="label_c1"></td><td class="field_c2"></td></tr>';
    	$result .= '<tr><td class="label_c1"></td><td class="field_c2">'.$this->getElement('submit'). 
    	'</td></tr>';
		$result .= '</table></form>';
    	return $result;
	} 
}
