<?php

class Form_Event extends Caclass_Form {
	
    public function init() {
    	
        $cities=Model_City::getCities();
            
        $city = new Zend_Form_Element_Select('city');
        $city->setMultiOptions($cities)
        	->setLabel('City : ')
        	 ->setAttrib('class', 'city')
        	 ->setRequired(true)
            ->addFilter('StringTrim')
            ->removeDecorator('Label')
            ->removeDecorator('Errors')
            ->removeDecorator('HtmlTag');  
            
    	$title = new Zend_Form_Element_Text('title');
        $title->setLabel('活动名称 : ')
            ->setAttrib('size', 48)
            ->setAttrib('maxlength',48)
            ->setRequired(true)
            ->addErrorMessage('不能为空 !')
            ->removeDecorator('HtmlTag')
             ->removeDecorator('Label')
              ->removeDecorator('Errors');
            
        $address = new Zend_Form_Element_Text('address');
        $address->setLabel('活动地点 : ')
        	->setAttrib('maxlength',150)
        	->setRequired(true)
        	->addErrorMessage('不能为空 !')
            ->setAttrib('size', '70')
            ->removeDecorator('Label')
           ->removeDecorator('Errors')
           ->removeDecorator('HtmlTag');
           
        $contact = new Zend_Form_Element_Text('contact');
        $contact->setLabel('联系人 : ')
        	->setAttrib('maxlength',100)
        //	->setRequired(true)
            ->setAttrib('size', 40)
            ->removeDecorator('Label')
           ->removeDecorator('Errors')
           ->removeDecorator('HtmlTag');   
           
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('电邮 : ')
            ->setAttrib('size', '30')
            ->setAttrib('maxlength',50)
            ->addFilter('StringTrim')
             ->removeDecorator('Label')
              ->removeDecorator('Errors')
             ->addValidator('EmailAddress')
             ->addErrorMessage('不能为空，且必须为邮件格式 !')
            ->removeDecorator('HtmlTag');
            
        $phone = new Zend_Form_Element_Text('phone');
        $phone->setLabel('电话 : ')
        	->setRequired(true)
        	->setAttrib('class','phone')
        	->addFilter('StringTrim')
        	->setAttrib('size', 15)
        	->setAttrib('maxlength',20)
        	 ->addErrorMessage('不能为空 ！ ')
             ->removeDecorator('Label')
             ->removeDecorator('Errors')
            ->removeDecorator('HtmlTag');
          /*        
            ->addValidators( array(
            		array('validator' => 'Regex', 
            		'options' => array('pattern'=>'/^[2-9][0-9]{2}-[0-9]{3}-[0-9]{4}$/', 
                  	'messages'=>array('regexInvalid'=>'required','regexNotMatch'=>'格式是 xxx-xxx-xxxx')))
        		));
           */ 
        $start = new Zend_Form_Element_Text('start');	
        $start->setAttrib('class', 'datepicker')
        		->setAttrib('size', '14')
        		->removeDecorator('HtmlTag')
            	->removeDecorator('Label')
             	->removeDecorator('Errors')
        		->setRequired(true)
        		 ->addValidator('Date', false, array('format' => 'YYYY-mm-dd'))
        		 ->addErrorMessage('不能为空 且格式是 YYYY-mm-dd !')
        		->setLabel('活动日期 : ');
        		
        $end = new Zend_Form_Element_Text('end');	
        $end->setAttrib('class', 'datepicker')
        		->setAttrib('size', '14')
        		->removeDecorator('HtmlTag')
            	->removeDecorator('Label')
             	->removeDecorator('Errors')
        		->setRequired(true)
        		 ->addValidator('Date', false, array('format' => 'YYYY-mm-dd'))
        		 ->addErrorMessage('不能为空，格式是 YYYY-mm-dd，且结束日期 要大于 开始日期！')
        		->setLabel('活动结束日期 : ');

        $arr1=array('00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06',
        '07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15',
        			'16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23');	
        
        $arr2=array('00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06',
        			'07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15',
        			'16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23',
        			'24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31',
        			'32'=>'32','33'=>'33','34'=>'34','35'=>'35','36'=>'36','37'=>'37','38'=>'38','39'=>'39',
        			'40'=>'40','41'=>'41','42'=>'42','43'=>'43','44'=>'44','45'=>'45','46'=>'46','47'=>'47',
        			'48'=>'48','49'=>'49','50'=>'50','51'=>'51','52'=>'52','53'=>'53','54'=>'54','55'=>'55',
        			'56'=>'56','57'=>'57','58'=>'58','59'=>'59');
        
        		
        $time1 = new Zend_Form_Element_Select('time1');
        $time1->setMultiOptions($arr1)
        	->setLabel('时间 : ')
        	->setRequired(true)
        	->setValue('09')
            ->addFilter('StringTrim')
            ->removeDecorator('Label')
            ->removeDecorator('Errors')
            ->removeDecorator('HtmlTag'); 

        $m1 = new Zend_Form_Element_Select('m1');
        $m1->setMultiOptions($arr2)
        	->setLabel('时间 : ')
        	->setRequired(true)
            ->addFilter('StringTrim')
            ->removeDecorator('Label')
            ->removeDecorator('Errors')
            ->removeDecorator('HtmlTag'); 

        $time2 = new Zend_Form_Element_Select('time2');
        $time2->setMultiOptions($arr1)
        	->setLabel('时间 : ')
        	->setRequired(true)
        	->setValue('17')
            ->addFilter('StringTrim')
            ->removeDecorator('Label')
            ->removeDecorator('Errors')
            ->removeDecorator('HtmlTag');
            
        $m2 = new Zend_Form_Element_Select('m2');
        $m2->setMultiOptions($arr2)
        	->setLabel('时间 : ')
        	->setRequired(true)
            ->addFilter('StringTrim')
            ->removeDecorator('Label')
            ->removeDecorator('Errors')
            ->removeDecorator('HtmlTag'); 
        		
        $img = new Zend_Form_Element_File('image');
        $img->setLabel('相关图片 : ')
        		->addValidator('Count', false, 1)
        		->addValidator('Extension',false,'jpg,png,gif,jpeg')
        		->addValidator('Size',false, array('max' =>'3Mb'))
        		 ->addErrorMessage('必须是jpg,png,gif,jpeg文件且大小不超过3Mb!')
        		->removeDecorator('DtDdWrapper')
        		 ->removeDecorator('Label')
        	  ->removeDecorator('Errors')
        		->removeDecorator('HtmlTag');
        		
        $button = new Zend_Form_Element_Submit('upload');
        $button->setAttrib('id', 'upload_img')
            	->setLabel('上传')
            	->removeDecorator('Label')
            	->removeDecorator('DtDdWrapper')
            	 ->removeDecorator('Errors')
        		 ->removeDecorator('HtmlTag'); 		
            
        $content = new Zend_Form_Element_Textarea('editor1');
        $content->setLabel('详细介绍 : ')
        		->addValidator('StringLength', false, array(1, 200000))
        		 ->removeDecorator('Label')
        		 ->setAttrib('maxlength',200000)
        	 	 ->removeDecorator('Errors')
        		 ->removeDecorator('HtmlTag')
        		 ->removeDecorator('DtDdWrapper')
        		->setRequired(true)
        		->addErrorMessage('不能为空 ，但不超过5000字符');
        		
       
       $chkcode = new Zend_Form_Element_Text('chkcode');
       $chkcode->setLabel('验证码 : ')
       			->setAttrib('size', '5')
       			 ->setAttrib('maxlength',5)
            	->removeDecorator('DtDdWrapper')
            	->removeDecorator('HtmlTag')
            	 ->removeDecorator('Label')
            	 ->removeDecorator('Errors');
       
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'new_custmer')
        		 ->removeDecorator('Label')
        		 ->removeDecorator('HtmlTag')
        		 ->removeDecorator('DtDdWrapper')
            	->setLabel('提交');
        
        $this->addElements(array($city,$title,$address,$contact,$email,$phone,$start,$end,$time1,
       	$m1,$time2,$m2,$img,$button,$content,$chkcode,$submit));
        
	    }
	
	 function __toString() 	{
	 	
	 	$this->render();
	 	
		$result = '<form enctype="multipart/form-data" method="post" action="">'; 
		
		$result .= "<table class='bigform'>";
		$result .= '<tr><td class="label_c1 required">活动名称 : </td><td class="field_c2">' .$this->getElement("title")->__toString().'&nbsp;&nbsp;&nbsp;所在地 : '.$this->getElement("city")->__toString().'</td></tr>';
		
		$result .= '<tr><td class="label_c1 required">活动地点 : </td><td class="field_c2">' .$this->getElement("address")->__toString().'</td></tr>';
		$result .= '<tr><td class="label_c1">联系人 : </td><td class="field_c2">' .$this->getElement("contact")->__toString().'&nbsp;&nbsp;&nbsp;<span class="required">电话 :</span> '.$this->getElement("phone")->__toString().'</td></tr>';
		$result .= '<tr><td class="label_c1">电邮 : </td><td class="field_c2">' .$this->getElement("email")->__toString().'</td></tr>';
		$result .= '<tr><td class="label_c1 required">活动日期 : </td><td class="field_c2">' .$this->getElement("start")->__toString().'&nbsp; to &nbsp'.$this->getElement("end")->__toString().'</td></tr>';
		$result .= '<tr><td class="label_c1 required">时间 : </td><td class="field_c2">' .$this->getElement("time1")->__toString().'&nbsp; : &nbsp'.$this->getElement("m1")->__toString().
			'&nbsp;to '.$this->getElement("time2")->__toString().'&nbsp; : &nbsp'.$this->getElement("m2")->__toString().'</td></tr>';
		
		$result .= '<tr><td class="label_c1">相关图片 : </td><td class="field_c2">' .$this->getElement("image")->__toString().'</td></tr>';	
		$result .= '<tr><td class="label_c1"></td><td class="field_c2">' .$this->getElement("upload")->__toString()."<span class='alert'>【最多可上传5张图片，每张不超过3Mb】</span><br/><div class='img_box'></div>".'</td></tr>';	
		
		$result .= '<tr><td class="label_c1 required">详细介绍 : </td><td class="field_c2">' . $this->getElement('editor1').'</td></tr>';
		$result .= '<tr><td class="label_c1 required">验证码 : </td><td class="field_c2">' . $this->getElement('chkcode')."<span class='verify'><img src='/image.php' /></span>".'</td></tr>';
		$result .= '<tr><td class="label_c1"></td><td class="field_c2 terms">点击提交，表明您已承诺所粘贴信息符合加拿大相关法律规定并遵守本站用户条约， 愿为此承担全部责任。' . '</td></tr>';
    	$result .= '<tr><td class="label_c1"></td><td class="field_c2">'.$this->getElement('submit'). 
    	'</td></tr>';
		$result .= '</table></form>';
    	return $result;
	} 
	    
	public function isValid($data)
	{
		$valid = parent::isValid($data);
		
		$date1=$this->getValue('start');
		$date2=$this->getValue('end');
		
		if (!Zend_Date::isDate($date1,'YYYY-MM-dd')) {
        	$valid = false;
        	$this->start->addError('日期格式不对 !');
		}
		
		if (!Zend_Date::isDate($date2,'YYYY-MM-dd')) {
        	$valid = false;
        	$this->end->addError('日期格式不对 !');
		}
		
		if (strtotime($date2)-strtotime($date1)<0) {
			$valid = false;
        	$this->end->addError('The end date must not be less than the start date !');
		}

		$chk=$this->getValue('chkcode');
		if ($_SESSION['check_pic']!=$chk) {
        	$valid = false;
        	$this->chkcode->addError('验证码不对 !');
		}
        return $valid;
	}
}
