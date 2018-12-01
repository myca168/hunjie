<?php

class Form_BbsMaster extends Zend_Form {
	
    public function init() {
    	
    	$name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name : ')
            ->setAttrib('size', '30')
            ->setAttrib('maxlength',50)
            ->setRequired(true)
            ->removeDecorator('HtmlTag');
  
        
        $login = new Zend_Form_Element_Text('login');
        $login->setLabel('Login : ')
            ->setAttrib('size', 30)
            ->setAttrib('maxlength',50)
             ->setRequired(true)
            ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag');
            
        $type = new Zend_Form_Element_Select('type');
        $type->setMultiOptions(Model_BbsType::getAllTypes())
        	->setLabel('BBS Type : ')
        	 ->setRequired(true)
            ->addFilter('StringTrim')
          //   ->removeDecorator('Label')
            ->removeDecorator('HtmlTag');
            
        $status = new Zend_Form_Element_Select('status');
        $status->setMultiOptions(array(Model_BbsType::STATUS_ACTIVE=>"Active",Model_BbsType::STATUS_INACTIVE=>"Inactive"))
        	->setLabel('Status : ')
        	 ->setRequired(true)
            ->addFilter('StringTrim')
            ->removeDecorator('DtDdWrapper')
          //   ->removeDecorator('Label')
            ->removeDecorator('HtmlTag');
            
        $notes = new Zend_Form_Element_Text('notes');
        $notes->setLabel('Notes : ')
            ->setAttrib('size', 50)
            ->setAttrib('id', 'master')
            ->setAttrib('maxlength',150)
            ->removeDecorator('HtmlTag');
            
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'new_custmer')
            	->setLabel('Submit');
        
        $this->addElements(array($name,$login,$type,$status,$notes,$submit));
        
	    }
	    
	public function isValid($data)
	{
		$valid = parent::isValid($data);
		if (!$valid) {return $valid;}
		
		$login=$this->getValue('login');
		if (!Model_User::getUserByLogin($login)) {
        	$valid = false;
        	$this->login->addError('Login was not found !');
		}
        return $valid;
	}
}
