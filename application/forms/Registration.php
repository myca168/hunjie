<?php

class Form_Registration extends Caclass_Form {
	
    public function init() {

        $this->setName('registration');
        $this->setAction($this->getView()->baseUrl().'/profile/new/');
        
        $nname = new Zend_Form_Element_Text('nname');
        $nname->setLabel('用户名 : ')
            ->setAttrib('size', '30')
            ->setAttrib('id', 'newid')
            ->setRequired(true)
             ->addFilter('StringTrim')
            ->addValidator('NotEmpty',true,array('messages'=>array('isEmpty'=>'账户不能为空 ！')))
            ->addValidator('StringLength',true,array(4,30,'messages'=>'账户需4-30字符 ！'))
           // ->addValidator('Alnum',false,array('messages'=>array('notAlnum'=>'只能是字母或数字 ！')))
           // ->addValidator('regex', true, array('/[a-z_0-9]/i')) 
            ->addValidator('regex', true, array('/^[a-zA-Z_0-9]*$/')) 
            ->addErrorMessage('不能为空,4~30字符,且只能是字母或数字!')
            ->removeDecorator('HtmlTag')
            ->removeDecorator('DtDdWrapper')
            ->removeDecorator('Label')
            ->removeDecorator('Errors'); 
  
        $uid = new Zend_Form_Element_Text('uid');
        $uid->setLabel('E-Mail : ')
            ->setAttrib('size', '30')
            ->setRequired(true)
            ->addFilter('StringTrim')
            ->addFilter('StringToLower')
            ->addValidator('EmailAddress')
            ->addErrorMessage('电子邮箱格式不对或邮箱已被占用 !')
            ->removeDecorator('DtDdWrapper')
            ->removeDecorator('HtmlTag')
            ->removeDecorator('Label')
            ->removeDecorator('Errors'); 
  
        $pwd1 = new Zend_Form_Element_Password('pwd1');
        $pwd1->setLabel('密码 : ')
        	->setRequired(true)
        	->addErrorMessage('密码不能为空 !')
            ->setAttrib('size', '30')
            ->removeDecorator('DtDdWrapper')
            ->removeDecorator('HtmlTag')
             ->removeDecorator('Label')
            ->removeDecorator('Errors'); 
        
        $pwd2 = new Zend_Form_Element_Password('pwd2');
        $pwd2->setLabel('重复输入密码 : ')
        	->setRequired(true)
            ->setAttrib('size', '30')
            ->addValidator('Identical', false, array('token' => 'pwd1'))
            ->addErrorMessage('密码与重复输入密码值不等 !')
            ->removeDecorator('DtDdWrapper')
            ->removeDecorator('HtmlTag')
            ->removeDecorator('Label')
            ->removeDecorator('Errors'); 

        $chkcode = new Zend_Form_Element_Text('chkcode');
       	$chkcode->setLabel('验证码 : ')
       			->setAttrib('size', '5')
       			 ->setAttrib('maxlength',5)
       			 ->setRequired(true)
       			 ->addValidator('NotEmpty',true,array('messages'=>array('isEmpty'=>'验证码不能为空 ！')))
            	->removeDecorator('DtDdWrapper')
            	->removeDecorator('HtmlTag')
            	 ->removeDecorator('Label')
            	 ->removeDecorator('Errors');    	 
        
        $submit = new Zend_Form_Element_Submit('register');
        $submit->setAttrib('id', 'new')
            	->setLabel('创建用户')
            	->addDecorator('HtmlTag', array('tag'=>'br','closeOnly'=>true,'placement'=>'prepend')) 
            	->removeDecorator('DtDdWrapper')
            	->removeDecorator('HtmlTag')
            	 ->removeDecorator('Label')
            	 ->removeDecorator('Errors'); 
        
        $this->addElements(array($nname,$uid,$pwd1,$pwd2,$chkcode,$submit));
 	  }
	    
	  function __toString() 	{
	 	
		$result = '<form enctype="multipart/form-data" method="post" action="">';

		$result .= "<table class='bigform'>";
		$result .= '<tr><td class="label_c1 required">用户ID  : </td><td class="field_c2">' .$this->getElement("nname")->__toString().' (仅英文字母或数字,不能有空格！)</td></tr>';
		$result .= '<tr><td class="label_c1 required">E-Mail : </td><td class="field_c2">' .$this->getElement("uid")->__toString().'</td></tr>';
		$result .= '<tr><td class="label_c1 required">密码 : </td><td class="field_c2">' .$this->getElement("pwd1")->__toString().'</td></tr>';
		$result .= '<tr><td class="label_c1 required">重复输入密码 : </td><td class="field_c2">' .$this->getElement("pwd2")->__toString().'</td></tr>';	
		$result .= '<tr><td class="label_c1 required">验证码 : </td><td class="field_c2">' . $this->getElement('chkcode')."<span class='verify'><img src='/image.php' /></span>".'</td></tr>';
		$result .= '<tr><td class="label_c1"></td><td class="field_c2"></td></tr>';
    	$result .= '<tr><td class="label_c1"></td><td class="field_c2">'.$this->getElement('register'). 
    	'</td></tr>';
		$result .= '</table></form>';
    	return $result;
	} 
	    
	public function isValid($data)
	{
		$valid = parent::isValid($data);
		if (!$valid) {return $valid;}
		$newid=$this->getValue('nname');
		$newemail=$this->getValue('uid');
		
		if (Model_User::getUserByLogin($newid)){
        	$valid = false;
        	$this->nname->addError('账户已被占用 !');
		}
		
		if (Model_User::getUserByEmail($newemail)){
        	$valid = false;
        	$this->uid->addError('邮箱已存在 !');
		}
		
		$chk=$this->getValue('chkcode');
		if ($_SESSION['check_pic']!=$chk) {
        	$valid = false;
        	$this->chkcode->addError('验证码不对 !');
		}

        return $valid;
	}
}