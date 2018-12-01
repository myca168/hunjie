<?php

class Form_Editads extends Zend_Form {
	
    public function init() {
    	
    	$cities=Model_City::getCities();
    	
        $city = new Zend_Form_Element_Select('city');
        $city->setMultiOptions($cities)
        	->setLabel('City Targeted : ')
        	 ->setAttrib('class', 'city')
        	 ->setRequired(true)
            ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag'); 
            
        $index = new Zend_Form_Element_Select('location');
        $pages=Model_Location::getLocations();
        $index->setMultiOptions($pages)
        	->setLabel('Select Location : ')
        	 ->setRequired(true)
            ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag'); 
        
        $countries=Model_Country::getRows();
        $arr=array('ONE'=>"默认城市",'ALL'=>"所有国家")+$countries;
         
        $region = new Zend_Form_Element_Select('region');
        $region->setMultiOptions($arr)
        ->setLabel('广告区域 : ')
        ->setAttrib('class', 'region')
        ->setRequired(true)
        ->addFilter('StringTrim')
        ->removeDecorator('HtmlTag');        
        
        $status = new Zend_Form_Element_Select('status');
        $status->setMultiOptions(array(Model_Ads::ACTIVE=>'Active Ads',Model_Ads::PENDING=>'Pending'))
        	 ->setRequired(true)
        	 ->setLabel('Set Status : ')
            ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag'); 
            
        $type = new Zend_Form_Element_Select('type');
        $type->setMultiOptions(array(Model_Ads::NORMAL=>'One Page',Model_Ads::ALL=>'All Pages'))
        	 ->setRequired(true)
        	 ->setLabel('Select One or All pages : ')
            ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag'); 
            

        $start = new Zend_Form_Element_Text('start');	
        $start->setAttrib('class', 'datepicker')
        		->setAttrib('size', '14')
        		->setLabel('Start (YYYY-mm-dd): ')
        		->removeDecorator('HtmlTag')
        		->setRequired(true)
        		 ->addValidator('Date', false, array('format' => 'YYYY-mm-dd'));
            
        $month = new Zend_Form_Element_Text('month');
        $month->setLabel('# of Months (1-60) : ')
        	 ->setAttrib('class', 'month')
        	 ->addValidator('Between',false, array(1,60)) 
        	 ->setRequired(true)
        	 ->setAttrib('size', '3')
        	 ->addValidator('Int') 
            ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag'); 
            
        $sqn = new Zend_Form_Element_Text('sqn');
        $sqn->setLabel('Ads Order # (1-99) : ')
        	 ->addValidator('Between',false, array(1,99)) 
        	 ->setRequired(true)
        	 ->setAttrib('size', '3')
        	 ->addValidator('Int') 
            ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag'); 
            
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'new_custmer')
            	->setLabel('Submit');
            //	->removeDecorator('DtDdWrapper');
        
        $this->addElements(array($city,$index,$region,$type,$status,$start,$month,$sqn,$submit));
        
	    }
	public function isValid($data)
	{
		$valid = parent::isValid($data);
		if (!$valid) {return $valid;}
		$date1=$this->getValue('start');
		
		if (!Zend_Date::isDate($date1,'YYYY-MM-dd')) {
        	$valid = false;
        	$this->start->addError('The start date is invalid !');
		}
        return $valid;
	}
}
