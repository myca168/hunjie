<?php

class Form_Permission extends Zend_Form {
	
    public function init() {
            
        $status = new Zend_Form_Element_Select('status');
        $options = array('Active' =>Model_Member::STATUS_ACTIVE,
        		'Inactive' =>Model_Member::STATUS_INACTIVE,
        		'Pending'=>Model_Member::STATUS_PENDING);
        $status-> setMultiOptions($options)
         		->removeDecorator('HtmlTag')
         		->setLabel('Status : ');
        
        $role = new Zend_Form_Element_Select('role_id');
        
        $opts=array(
        		Caclass_Acl::ROLE_USER=>Caclass_Acl::ROLE_USER,
        		Caclass_Acl::ROLE_ADMIN=>Caclass_Acl::ROLE_ADMIN,
        		Caclass_Acl::ROLE_MANAGER=>Caclass_Acl::ROLE_MANAGER,
        		Caclass_Acl::ROLE_AGENT=>Caclass_Acl::ROLE_AGENT,
        		Caclass_Acl::ROLE_BILLING=>Caclass_Acl::ROLE_BILLING
        		);
        	
        $role->setMultiOptions($opts)
         		->removeDecorator('HtmlTag')
         		->setLabel('User Role : ');
        
         
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'new_btn')
            	->setLabel('Update')
            	->addDecorator('HtmlTag', array('tag'=>'br','closeOnly'=>false,'placement'=>'prepend')) 
            	->removeDecorator('DtDdWrapper');
        
        $this->addElements(array($status,$role,$submit));
        
	    }
}
