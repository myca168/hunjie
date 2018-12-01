<?php

class Form_Password extends Zend_Form {
	
    public function init() {

        $oldpwd = new Zend_Form_Element_Password('oldpwd');
        $oldpwd->setLabel('密码 : ')
        	->setRequired(true)
        	->addValidator('NotEmpty',true,array('messages'=>array('isEmpty'=>'账户不能为空 ！')))
        	->addFilter('StringTrim')
            ->setAttrib('size', '30')
            ->removeDecorator('HtmlTag')
          //  ->removeDecorator('Label')
            ->addValidator('StringLength', false, array(1, 30));
        
        $newpwd1 = new Zend_Form_Element_Password('newpwd1');
        $newpwd1->setLabel('新密码 : ')
        	->setRequired(true)
        	->addValidator('NotEmpty',true,array('messages'=>array('isEmpty'=>'不能为空 ！')))
        	->addFilter('StringTrim')
            ->setAttrib('size', '30')
            ->removeDecorator('HtmlTag');
            
        $newpwd2 = new Zend_Form_Element_Password('newpwd2');
        $newpwd2->setLabel('重新输入新密码 : ')
        	->setRequired(true)
        	->addFilter('StringTrim')
            ->setAttrib('size', '30')
            ->removeDecorator('HtmlTag')
            ->addValidator('Identical', false, array('token' => 'newpwd1'))
            ->addErrorMessage('值不能为空，且新密码与重复输入密码值需相等 !')
            ->addDecorator('HtmlTag', array('tag'=>'br','placement'=>'append')) ;
            
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'new_btn')
            	->setLabel('提交')
            	->removeDecorator('DtDdWrapper');
        
        $this->addElements(array($oldpwd,$newpwd1,$newpwd2,$submit));
        
	    }
	    
	public function isValid($data)
	{
		$view=$this->getView();
		$valid = parent::isValid($data);
	//	if (!$valid) {return $valid;}
		$oldPwd=$this->getValue('oldpwd');
		
		if (!Model_Member::getUser($view->email,md5($oldPwd))){
        	$valid = false;
        	$this->oldpwd->addError('密码不对 !');
		}

        return $valid;
	}
}
