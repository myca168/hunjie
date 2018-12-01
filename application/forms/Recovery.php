<?php

class Form_Recovery extends Zend_Form {
	
    public function init() {

        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('电邮 : ')
        	->setRequired(true)
        	 ->addFilter('StringTrim')
            ->addFilter('StringToLower')
            ->addValidator('EmailAddress')
          //  ->addErrorMessage('不能为空，且必须为邮件格式 !')
            ->setAttrib('size', '30')
           // ->removeDecorator('HtmlTag')
           // ->removeDecorator('Label')
            ->addValidator('StringLength', false, array(5, 30));
            
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'new_btn')
            	->setLabel('提交')
            	->removeDecorator('HtmlTag')
           		->removeDecorator('Label')
           		->removeDecorator('DtDdWrapper');
        
        $this->addElements(array($email,$submit));
        
	    }
	    
	public function isValid($data)
	{
		$valid = parent::isValid($data);
		if (!$valid) {return $valid;}
		$email=$this->getValue('email');
		
		if (!Model_Member::getUserByEmail($email)){
        	$valid = false;
        	$this->email->addError('电邮不对 !');
		}

        return $valid;
	}
}
