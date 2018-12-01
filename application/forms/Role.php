<?php

class Form_Role extends Zend_Form {
	
    public function init() {

        $role = new Zend_Form_Element_Text('role');

        $role->setLabel('Role :')
            ->setAttrib('size', '35')
            ->setRequired(true)
            ->addFilter('StringTrim')
             ->removeDecorator('HtmlTag')
            ->removeDecorator('Label');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton')
            ->setLabel('Login')
          	->removeDecorator('HtmlTag')
           ->removeDecorator('Label')
           ->removeDecorator('DtDdWrapper');
        
        $this->addElements(array($role, $submit));
        
    }
}
