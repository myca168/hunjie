<?php

class Form_Profile extends Zend_Form {
	
    public function init() {

        $this->setName('registration');
        $this->setAction($this->getView()->baseUrl().'/profile/new/');

        $uid = new Zend_Form_Element_Text('uid');
        $uid->setLabel('Login Email : ')
            ->setAttrib('size', '30')
            ->setRequired(true)
            ->addFilter('StringTrim')
            ->addFilter('StringToLower')
            ->addValidator('EmailAddress')
            ->removeDecorator('HtmlTag')
         //   ->removeDecorator('Label')
            ->addValidator('stringLength', false, array(5, 30));

        $pwd1 = new Zend_Form_Element_Password('pwd1');
        $pwd1->setLabel('Your Password : ')
        	->setRequired(true)
        //	->addFilter('StringTrim')
            ->setAttrib('size', '30')
            ->removeDecorator('HtmlTag')
          //  ->removeDecorator('Label')
            ->addValidator('StringLength', false, array(5, 30));
        
        $pwd2 = new Zend_Form_Element_Password('pwd2');
        $pwd2->setLabel('Password Again : ')
        	->setRequired(true)
        //	->addFilter('StringTrim')
            ->setAttrib('size', '30')
            ->removeDecorator('HtmlTag')
            ->addValidator('StringLength', false, array(5, 30))
            ->addValidator('Identical', false, array('token' => 'pwd1'))
            ->addErrorMessage('The given passwords do not match !');
            
        $fname = new Zend_Form_Element_Text('fname');
        $fname->setLabel('Full Name : ')
            ->setAttrib('size', '60')
            ->removeDecorator('HtmlTag');
        //    ->addFilter('StringTrim');  uft8 no working
            
        $tel = new Zend_Form_Element_Text('tel');
        $tel->setLabel('Phone Number : ')
            ->setAttrib('size', '50')
            ->removeDecorator('HtmlTag');
            
        $fax = new Zend_Form_Element_Text('fax');
        $fax->setLabel('Fax Number : ')
            ->setAttrib('size', '50')
            ->removeDecorator('HtmlTag');
        
        $street = new Zend_Form_Element_Text('street');
        $street->setLabel('Street : ')
            ->setAttrib('size', '80')
      //      ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag');

        $city = new Zend_Form_Element_Text('city');
        $city->setLabel('City : ')
            ->setAttrib('size', '50')
       //     ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag');
            
        $province = new Zend_Form_Element_Text('province');
        $province->setLabel('Province : ')
            ->setAttrib('size', '30')
       //     ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag');
            
        $country = new Zend_Form_Element_Text('country');
        $country->setLabel('Country :')
            ->setAttrib('size', '30')
      //      ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag');
            
        $zip = new Zend_Form_Element_Text('zipcode');
        $zip->setLabel('Zip Code :')
            ->setAttrib('size', '20')
        //    ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag');
            
        $site = new Zend_Form_Element_Text('site');
        $site->setLabel('Web Site :')
            ->setAttrib('size', '50')
       //     ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag');
         //   ->addDecorator('HtmlTag', array('tag'=>'br', 'placement'=>'append'));
         
        $submit = new Zend_Form_Element_Submit('register');
        $submit->setAttrib('id', 'new_btn')
            	->setLabel('Submit')
            	->addDecorator('HtmlTag', array('tag'=>'br','closeOnly'=>true,'placement'=>'prepend')) 
            	->removeDecorator('DtDdWrapper');
        
        $this->addElements(array($uid,$pwd1,$pwd2,$fname,$street,$city,$province,$country,$zip,$site,$submit));
        
	    }
}
