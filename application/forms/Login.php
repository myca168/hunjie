<?php

class Form_Login extends Zend_Form {
	
    public function init() {
    	
        $email = new Zend_Form_Element_Text('myemail');

        $email->setLabel('email :')
            ->setAttrib('size', '30')
            ->setRequired(true)
            ->addFilter('StringTrim')
            ->addFilter('StringToLower')
       //     ->addValidator('EmailAddress')
             ->removeDecorator('HtmlTag')
            ->removeDecorator('Label')
        //    ->addErrorMessage('The login email is not correct !')
            ->addValidator('StringLength', false, array(5, 50));

        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Your Password :')
        	->setRequired(true)
        	->addFilter('StringTrim')
            ->setAttrib('size', '8')
            ->removeDecorator('HtmlTag')
           	->removeDecorator('Label')
           	->addErrorMessage('The password is incorrect !')
            ->addValidator('StringLength', false, array(5, 30));

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'login_btn')
        	->setAttrib('class', 'go')
            ->setLabel('登录')
          	->removeDecorator('HtmlTag')
           ->removeDecorator('Label')
           ->removeDecorator('DtDdWrapper');
        
        $this->addElements(array($email, $password, $submit));
        
    }
	function __toString() {
		$result = "<form id='login' enctype='application/x-www-form-urlencoded' method='post' action=''>"; 
		$result .= '电邮:'.$this->getElement("myemail").' 密码 :'.$this->getElement("password");
		$result .=$this->getElement("submit").'<a class="info" href="/member/new">立即注册 </a>'.'<a class="info" href="/profile/recovery">找回密码 </a>'.'</form>';
		return $result;
    }
 }
