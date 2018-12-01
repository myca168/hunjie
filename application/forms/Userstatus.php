<?php

class Form_Userstatus extends Zend_Form {
	
    public function init() {
            
        $nickname = new Zend_Form_Element_Text('nickname');
        $nickname->setLabel('Login ID : ')
            ->setAttrib('size', '30')
            ->setAttrib('disabled', 'disabled')
            ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag');
            
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email : ')
            ->setAttrib('size', '30')
            ->setAttrib('disabled', 'disabled')
            ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag');
            
        $status = new Zend_Form_Element_Select('status');
               $options = array('Active' =>Model_User::STATUS_ACTIVE,'Inactive' =>Model_User::STATUS_INACTIVE,'Pending'=>Model_User::STATUS_PENDING);
        $status-> setMultiOptions($options)
         		->removeDecorator('HtmlTag')
         		->setLabel('Status : ');
        
        $role = new Zend_Form_Element_Select('role_id');
        $user=Zend_Auth::getInstance()->getIdentity();
        if ($user->role_id=='Admin' ||$user->role_id=='SuperAdmin')	{
        	$opts=Caclass_Roles::getRoles();
        } else { $opts=Caclass_Roles::getSomeRoles();}	
        $role->setMultiOptions($opts)
         		->removeDecorator('HtmlTag')
         		->setLabel('User Role : ');
        
         
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'new_btn')
            	->setLabel('Update')
            	->addDecorator('HtmlTag', array('tag'=>'br','closeOnly'=>false,'placement'=>'prepend')) 
            	->removeDecorator('DtDdWrapper');
        
        $this->addElements(array($nickname,$email,$status,$role,$submit));
        
	    }
}
