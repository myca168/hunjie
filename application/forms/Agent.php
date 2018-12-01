<?php
/**
 * 
 * @For House Agent
 *
 */
class Form_Agent extends Caclass_Form {
	
    public function init() {
    	
    	$name = new Zend_Form_Element_Text('name');
        $name->setLabel('姓名  : ')
            ->setAttrib('size', '60')
            ->setAttrib('maxlength',80)
            ->setRequired(true)
            ->addErrorMessage('不能为空 !')
            ->removeDecorator('HtmlTag')
             ->removeDecorator('Label')
              ->removeDecorator('Errors');
    	
    	$title = new Zend_Form_Element_Text('title');
        $title->setLabel('头衔 : ')
            ->setAttrib('size', 40)
            ->setAttrib('maxlength',60)
            ->removeDecorator('HtmlTag')
            ->removeDecorator('Label')
            ->removeDecorator('Errors');
            
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('电邮 : ')
            ->setAttrib('size', '30')
            ->setAttrib('maxlength',50)
            ->setRequired(true)
            ->addFilter('StringTrim')
             ->removeDecorator('Label')
              ->removeDecorator('Errors')
             ->addValidator('EmailAddress')
             ->addErrorMessage('不能为空，且必须为邮件格式 !')
            ->removeDecorator('HtmlTag');
            
        $firm = new Zend_Form_Element_Text('firm');
        $firm->setLabel('公司名 : ')
            ->setAttrib('size', 60)
            ->setAttrib('maxlength',100)
            ->removeDecorator('HtmlTag')
             ->removeDecorator('Label')
              ->removeDecorator('Errors');
            
        $address = new Zend_Form_Element_Text('address');
        $address->setLabel('地址 : ')
        	->setAttrib('maxlength',150)
            ->setAttrib('size', '80')
            ->removeDecorator('Label')
           ->removeDecorator('Errors')
           ->removeDecorator('HtmlTag');
           
        $start = new Zend_Form_Element_Text('start');	
        $start->setAttrib('class', 'datepicker')
        		->setAttrib('size', '14')
        		->removeDecorator('HtmlTag')
        		->setRequired(true)
        		 ->addValidator('Date', false, array('format' => 'YYYY-mm-dd'))
        		 ->addErrorMessage('不能为空 且格式是 YYYY-mm-dd ')
        		->setLabel('生效日期 : ')
        		->removeDecorator('DtDdWrapper')
             	->removeDecorator('Label')
             	->removeDecorator('Errors');
        		
            
        $month = new Zend_Form_Element_Text('month');
        $month->setLabel('有效期  : ')
        	 ->setAttrib('class', 'month')
        	 ->addValidator('Between',false, array(1,96)) 
        	 ->setRequired(true)
        	  ->addErrorMessage('不能为空 且值必须为1~96整数!') 
        	 ->setAttrib('size', '3')
        	 ->addValidator('Int') 
            ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag')
            ->removeDecorator('DtDdWrapper')
             ->removeDecorator('Label')
             ->removeDecorator('Errors');
             
  		$flag = new Zend_Form_Element_Select('flag');
       	$flag->setMultiOptions(array(1=>"No",2=>'Yes'))
       			->setLabel('申请 VIP : ')
       			->removeDecorator('DtDdWrapper')
             	->removeDecorator('Label')
             	->removeDecorator('Errors')
              	->removeDecorator('HtmlTag');   
           
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
            
        $mainphone = new Zend_Form_Element_Text('mainphone');
        $mainphone->setLabel('固定电话 : ')
        	->setRequired(true)
        	->setAttrib('class','phone')
        	->addFilter('StringTrim')
        	->setAttrib('size', 20)
        	->setAttrib('maxlength',20)
        	->addErrorMessage('不能为空 且格式是 xxx-xxx-xxxx')
             ->removeDecorator('Label')
             ->removeDecorator('Errors')
            ->removeDecorator('HtmlTag')
            ->addValidators( array(
            		array('validator' => 'Regex', 
            		'options' => array('pattern'=>'/^[2-9][0-9]{2}-[0-9]{3}-[0-9]{4}$/', 
                  	'messages'=>array('regexInvalid'=>'required','regexNotMatch'=>'格式是 xxx-xxx-xxxx')))
        		));
            
        $ext1 = new Zend_Form_Element_Text('ext1');
        $ext1->setLabel(' Extension : ')
        	->setAttrib('class','ext')
        	->setAttrib('maxlength',8)
            ->setAttrib('size', '8')
            ->removeDecorator('Label')
            ->removeDecorator('Errors')
            ->removeDecorator('HtmlTag');
          //  $ext1->setDecorators(array( 'ViewHelper', 'Errors', 'Label'));
            
       $phone = new Zend_Form_Element_Text('phone');
       $phone->setLabel('备用电话  : ')
        	->setAttrib('class','phone')
        	->addFilter('StringTrim')
            ->setAttrib('size', '20')
            ->setAttrib('maxlength',20)
            ->removeDecorator('Label')
            ->removeDecorator('Errors')
            ->removeDecorator('HtmlTag')
            ->addValidators( array(
            		array('validator' => 'Regex', 
            		'options' => array('pattern'=>'/^[2-9][0-9]{2}-[0-9]{3}-[0-9]{4}$/', 
                  	'messages'=>array('regexInvalid'=>'required','regexNotMatch'=>'格式是 xxx-xxx-xxxx')))
        		));
            
        $ext2 = new Zend_Form_Element_Text('ext2');
        $ext2->setLabel('Extension : ')
        	->setAttrib('class','ext')
            ->setAttrib('size', '8')
            ->setAttrib('maxlength',8)
            ->removeDecorator('Label')
            ->removeDecorator('Errors')
            ->removeDecorator('HtmlTag');
            
       $fax = new Zend_Form_Element_Text('fax');
       $fax->setLabel('传真 : ')
        	->addFilter('StringTrim')
            ->setAttrib('size', '20')
            ->setAttrib('maxlength',20)
             ->removeDecorator('Label')
             ->removeDecorator('Errors')
            ->removeDecorator('HtmlTag')
                      ->addValidators( array(
            		array('validator' => 'Regex', 
            		'options' => array('pattern'=>'/^[2-9][0-9]{2}-[0-9]{3}-[0-9]{4}$/', 
                  	'messages'=>array('regexInvalid'=>'required','regexNotMatch'=>'格式是 xxx-xxx-xxxx')))
        		));
  
            
       $mobile = new Zend_Form_Element_Text('mobile');
       $mobile->setLabel('移动电话  : ')
        	->addFilter('StringTrim')
            ->setAttrib('size', '20')
            ->setAttrib('maxlength',20)
            ->removeDecorator('Label')
            ->removeDecorator('Errors')
            ->removeDecorator('HtmlTag')
             ->addValidators( array(
            		array('validator' => 'Regex', 
            		'options' => array('pattern'=>'/^[2-9][0-9]{2}-[0-9]{3}-[0-9]{4}$/', 
                  	'messages'=>array('regexInvalid'=>'required','regexNotMatch'=>'格式是 xxx-xxx-xxxx')))
        		));
            
        $site = new Zend_Form_Element_Text('site');
        $site->setLabel('个人主页 : ')
            ->setAttrib('size', 50)
             ->setAttrib('maxlength',60)
            ->addValidator('Hostname')
            ->addFilter('StringTrim')
             ->addErrorMessage('格式不对!')
             ->removeDecorator('Label')
             ->removeDecorator('Errors')
            ->removeDecorator('HtmlTag');
        		
        $img = new Zend_Form_Element_File('image');
        $img->setLabel('照片 : ')
        	//	->setRequired(true)
        		->addValidator('Count', false, 1)
        		->addValidator('Extension',false,'jpg,png,gif,jpeg')
        		->addValidator('Size',false, array('max' =>'300kb'))
        		->addErrorMessage('必须是jpg,png,gif,jpeg文件且大小不超过300kb!')
        		->removeDecorator('DtDdWrapper')
        		 ->removeDecorator('Label')
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
        		->addErrorMessage('不能为空，且不超过5000字符');
       
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
        
        $this->addElements(array($name,$title,$email,$firm,$address,$city,$start,$month,$flag, 
        $mainphone,$ext1,$phone,$ext2,$fax,$mobile,$site,$img,$content,$chkcode,$submit));
        
	    }
	
	 function __toString() 	{
	 	
	 	$this->render();
	 	
	 	$rate=Zend_Registry::get('config')->payment->month->rate;  
	 	
		$result = '<form enctype="multipart/form-data" method="post" action="">'; 
		
		$result .= "<table class='bigform'>";
		$result .= '<tr><td class="label_c1 required">姓名 : </td><td class="field_c2">' .$this->getElement("name")->__toString().'</td></tr>';
		$result .= '<tr><td class="label_c1">头衔 : </td><td class="field_c2">' .$this->getElement("title")->__toString().' 【如金牌经纪，可选】'.'</td></tr>';
		$result .= '<tr><td class="label_c1 required">电邮 : </td><td class="field_c2">' .$this->getElement("email")->__toString().'</td></tr>';
		$result .= '<tr><td class="label_c1">公司名 : </td><td class="field_c2">' .$this->getElement("firm")->__toString().'</td></tr>';
		$result .= '<tr><td class="label_c1">地址 : </td><td class="field_c2">' .$this->getElement("address")->__toString().'</td></tr>';
		
		$result .= '<tr><td class="label_c1 required">申请 VIP : </td><td class="field_c2">' .$this->getElement("flag")->__toString()."<span class='alert'>【加元 $rate/月, VIP 经纪可以随意设一条免费置顶广告】</span>".'</td></tr>';
		$result .= '<tr><td class="label_c1 required">广告生效日期  : </td><td class="field_c2">' .$this->getElement("start")->__toString().'&nbsp;&nbsp;&nbsp;<span class="required">有效期 (1-96月) :</span> '.$this->getElement("month")->__toString().'</td></tr>';
		
		$result .= '<tr><td class="label_c1 required">所在地 : </td><td class="field_c2">' .$this->getElement("city")->__toString().'</td></tr>';
	
		$result .= '<tr><td class="label_c1 required">固定电话 ： </td><td class="field_c2">' .$this->getElement("mainphone")->__toString().' 【格式：xxx-xxx-xxxx】&nbsp;&nbsp;&nbsp;分机 : '.$this->getElement("ext1")->__toString().'</td></tr>';
		$result .= '<tr><td class="label_c1">备用电话 : </td><td class="field_c2">' .$this->getElement("phone")->__toString()."&nbsp;&nbsp;&nbsp;分机 : ".$this->getElement("ext2")->__toString().'</td></tr>';
		$result .= '<tr><td class="label_c1">传真 : </td><td class="field_c2">' .$this->getElement("fax")->__toString().'</td></tr>';
		$result .= '<tr><td class="label_c1">移动电话 : </td><td class="field_c2">' .$this->getElement("mobile")->__toString().'</td></tr>';		
		$result .= '<tr><td class="label_c1">个人主页 : </td><td class="field_c2">' .$this->getElement("site")->__toString().' 【格式如： www.caclass.com】'.'</td></tr>';	
		$result .= '<tr><td class="label_c1">经纪人照片 : </td><td class="field_c2">' .$this->getElement("image")->__toString().' 【建议格式： 120px * 180px，大于该尺寸将自动缩小】'.'</td></tr>';	
		$result .= '<tr><td class="label_c1 required">详细介绍 : </td><td class="field_c2">' . $this->getElement('editor1').'</td></tr>';
		$result .= '<tr><td class="label_c1 required">验证码 : </td><td class="field_c2">' . $this->getElement('chkcode')."<span class='verify'><img src='/image.php' /></span>".'</td></tr>';
		$result .= '<tr><td class="label_c1"></td><td class="field_c2 terms">点击提交，表明您已承诺所粘贴信息符合加拿大相关法律规定并遵守本站用户条约， 愿为此承担全部责任。 ' . '</td></tr>';
    	$result .= '<tr><td class="label_c1"></td><td class="field_c2">'.$this->getElement('submit'). 
    	'</td></tr>';
		$result .= '</table></form>';
    	return $result;
	} 
	
	public function isValid($data)
	{
		$valid = parent::isValid($data);
		if (!$valid) {return $valid;}
		$date1=$this->getValue('start');
		
		if (!Zend_Date::isDate($date1,'YYYY-MM-dd')) {
        	$valid = false;
        	$this->start->addError('日期格式不对 !');
		}
		
	//	if (!$valid) {return $valid;}
		$chk=$this->getValue('chkcode');
		if ($_SESSION['check_pic']!=$chk) {
        	$valid = false;
        	$this->chkcode->addError('验证码不对 !');
		}
        return $valid;
	}
}
