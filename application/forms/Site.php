<?php

class Form_Site extends Zend_Form {
	
    public function init() {
    	
    	$this->setAttrib('id', 'fm');

        $name = new Zend_Form_Element_Text('company');
        $name->setLabel('Company Name : ')
            ->setAttrib('size', '60')
            ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag');
         //   ->removeDecorator('Label')
         
        $online = new Zend_Form_Element_Select('online');		
        $options = array('Yes' => 'Yes','No' => 'No');
        $online-> setMultiOptions($options)
         		->removeDecorator('HtmlTag')
         		->setLabel('Online Status : ');
         		
        $keywords = new Zend_Form_Element_Textarea('keywords');
        $keywords->setLabel('Key Words (Max 255) : ')
         		->addValidator('StringLength', false, array(0, 800))
        		->setAttrib('cols',60)
        		->setAttrib('rows',2);
        		
        $desc = new Zend_Form_Element_Textarea('sitedescription');
        $desc->setLabel('Description (Max 255) : ')
         		->addValidator('StringLength', false, array(0, 800))
        		->setAttrib('cols',60)
        		->setAttrib('rows',2);
        
        $sitename = new Zend_Form_Element_Text('sitename');
        $sitename->setLabel('Site Name : ')
            ->setAttrib('size', '50')
            ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag');
            
        $webmaster = new Zend_Form_Element_Text('webmaster');
        $webmaster->setLabel('Webmaster Email : ')
            ->setAttrib('size', '50')
            ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag');
            
        $tel = new Zend_Form_Element_Text('tel');
        $tel->setLabel('Phone Number : ')
            ->setAttrib('size', '50')
            ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag');
            
        $fax = new Zend_Form_Element_Text('fax');
        $fax->setLabel('Fax Number : ')
            ->setAttrib('size', '50')
            ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag');
        
        $address = new Zend_Form_Element_Text('address');
        $address->setLabel('Address : ')
            ->setAttrib('size', '70')
            ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag');
        
        $submit = new Zend_Form_Element_Submit('Update');
        $submit->setAttrib('id', 'new_btn')
            	->removeDecorator('DtDdWrapper');
        
        $this->addElements(array($name,$online,$keywords,$desc,$sitename,$webmaster,$tel,$fax,$address,$submit));
        
	    }
}
