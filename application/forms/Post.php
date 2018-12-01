<?php

class Form_Post extends Zend_Form {
	
    public function init() {
    	
             
    	$name = new Zend_Form_Element_Text('name');
        $name->setLabel('您的姓名 : ')
            ->setAttrib('size', '50')
            ->setRequired(true)
             ->addErrorMessage('不能为空 !')
            ->addValidator('StringLength', false, array(1, 50))
            ->removeDecorator('HtmlTag');
         //  ->addFilter('StringTrim');
            
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('您的E-mail : ')
            ->setAttrib('size', '30')
            ->setRequired(true)
           // ->addFilter('StringTrim')
            ->addValidator('EmailAddress')
            ->addErrorMessage('不能为空，且必须为邮件格式 !')
            ->removeDecorator('HtmlTag');
            
        $title = new Zend_Form_Element_Text('title');
        $title->setLabel('标题 : ')
        	->setRequired(true)
        	//->addFilter('StringTrim')
        	->addValidator('StringLength', false, array(1, 70))
        	->addErrorMessage('不能为空 ，且不超过70字符')
            ->setAttrib('size', '70')
            ->removeDecorator('HtmlTag');
            
        $content = new Zend_Form_Element_Textarea('content');
        $content->setLabel('内容 : ')
        		->addValidator('StringLength', false, array(1, 20000))
        		->setAttrib('COLS', '60')
    			->setAttrib('ROWS', '4')        		
        		->setRequired(true)
        		->addErrorMessage('不能为空 ，且不超过20000字符')
        		 ->removeDecorator('HtmlTag');
             
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'new_custmer')
            	->setLabel('发送信息');
            	//->removeDecorator('DtDdWrapper');
        
        $this->addElements(array($name,$email,$title,$content,$submit));
        
	    }
}
