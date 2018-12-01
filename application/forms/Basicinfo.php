<?php

class Form_Basicinfo extends Zend_Form {
	
    public function init() {

          $fname = new Zend_Form_Element_Text('fname');
        $fname->setLabel('用户名 : ')
            ->setAttrib('size', '60')
            ->removeDecorator('HtmlTag')
             ->addValidator('StringLength',true,array(0,60,'messages'=>'账户需0-60字符 ！'));
      //      ->addFilter('StringTrim');    //no working in uft8
            
        $sex = new Zend_Form_Element_Select('sex');		
        $typeOptions = array(
        			'Male' => '男',
        			'Female' => '女',
        			'NA' => 'N/A'
        			);
        			
        $sex-> setMultiOptions($typeOptions)
         		->removeDecorator('HtmlTag')
         		->setLabel('性别 : ');
       
        $street = new Zend_Form_Element_Text('street');
        $street->setLabel('地址 : ')
            ->setAttrib('size', '60')
            ->addValidator('StringLength', false, array(0, 80))
            ->addValidator('StringLength',true,array(0,80,'messages'=>'限0-80字符 ！'))
        //    ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag');

        $city = new Zend_Form_Element_Text('city');
        $city->setLabel('城市 : ')
            ->setAttrib('size', '50')
            ->addValidator('StringLength',true,array(0,50,'messages'=>'限0-50字符 ！')) 
        //    ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag');
            
        $province = new Zend_Form_Element_Text('province');
        $province->setLabel('省/州 : ')
            ->setAttrib('size', '30')
            ->addValidator('StringLength',true,array(0,50,'messages'=>'限0-50字符 ！')) 
        //    ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag');
            
        $country = new Zend_Form_Element_Text('country');
        $country->setLabel('国家 :')
            ->setAttrib('size', '30')
            ->addValidator('StringLength',true,array(0,50,'messages'=>'限0-50字符 ！')) 
        //    ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag');
            
        $zip = new Zend_Form_Element_Text('zipcode');
        $zip->setLabel('邮编 :')
            ->setAttrib('size', '20')
            ->addValidator('StringLength',true,array(0,20,'messages'=>'限0-50字符 ！')) 
        //    ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag');
            
        $resume = new Zend_Form_Element_Textarea('resume');
            
        // element options
        $resume->setLabel('本人介绍 (限 800字符) : ')
         		->addValidator('StringLength',true,array(0,800,'messages'=>'限0-800字符 ！')) 
        		->setAttrib('cols',60)
        		->setAttrib('rows',4)
        		->addDecorator('HtmlTag', array('tag'=>'br','placement'=>'append'));
            
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'new_btn')
            	->setLabel('提交')
            	->removeDecorator('DtDdWrapper');
        
        $this->addElements(array($fname,$sex,$street,$city,$province,$country,$zip,$resume,$submit));
        
	    }
}
