<?php

class Form_Reply extends Zend_Form {
	
    public function init() {
    	
    	$this->setAttrib('class','comments');
    	
    	$title = new Zend_Form_Element_Text('mtitle');
    	$title->setLabel('标题 : ')
    	->setAttrib('size', '65')
    	->setRequired(true)
    	->addFilter('StringTrim')
    	->addErrorMessage('标题不能为空!');
    //	->removeDecorator('HtmlTag')
    //	->removeDecorator('DtDdWrapper')
    //	->removeDecorator('Label')
    //	->removeDecorator('Errors');
    	
    	$comment = new Zend_Form_Element_Textarea('comment');
            
        // element options
        $comment->setLabel('内容 : ')
         		->addValidator('StringLength',true,array(0,20000,'messages'=>'限0-20000字符 ！')) 
        		->setAttrib('cols',64)
        		->setAttrib('rows',8)
        		 ->addErrorMessage('内容不能为空,且不超过20000字符!')
        		->setRequired(true);
        //		->addDecorator('HtmlTag', array('tag'=>'br','placement'=>'append'));
            
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'pop_btn')
            	->setLabel('提交')
            	->removeDecorator('DtDdWrapper');
        
        $this->addElements(array($title,$comment,$submit));
       }
}
