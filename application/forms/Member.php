<?php

class Form_Member extends Caclass_Form{
	
    public function init() {
    	
    	$name = new Zend_Form_Element_Text('name');
    	$name->setLabel('名字: ')
    	->setAttrib('size', 18)
    	->setAttrib('maxlength',30)
    	->setRequired(true)
    	->addErrorMessage('不能为空 !')
    	->removeDecorator('HtmlTag')
    	// ->addFilter('StringTrim')
    	->removeDecorator('DtDdWrapper')
    	->removeDecorator('Label')
    	->removeDecorator('Errors');
    	
    	$lname = new Zend_Form_Element_Text('lname');
    	$lname->setLabel('姓:')
    	->setAttrib('size', 8)
    	->setAttrib('maxlength',20)
    	->setRequired(true)
    	->addErrorMessage('不能为空 !')
    	->removeDecorator('HtmlTag')
    	// ->addFilter('StringTrim')
    	->removeDecorator('DtDdWrapper')
    	->removeDecorator('Label')
    	->removeDecorator('Errors');
    	
    	$email = new Zend_Form_Element_Text('email');
    	$email->setLabel('电邮 : ')
    	->setAttrib('size', 30)
    	->setAttrib('maxlength',30)
    	->setRequired(true)
    	->addFilter('StringTrim')
    	->addValidator('EmailAddress')
    	->addErrorMessage('必须为邮件格式，且不能重复注册 !')
    	->removeDecorator('HtmlTag')
    	->removeDecorator('DtDdWrapper')
    	->removeDecorator('Label')
    	->removeDecorator('Errors');
    	
    	$pwd = new Zend_Form_Element_Password('pwd');
    	$pwd->setLabel('密码 : ')
    	->setRequired(true)
    	->addErrorMessage('密码不能为空 !')
    	->setAttrib('size', '20')
    	->removeDecorator('DtDdWrapper')
    	->removeDecorator('HtmlTag')
    	->removeDecorator('Label')
    	->removeDecorator('Errors');
    	
    	$sex = new Zend_Form_Element_Radio('sex');
    	$sex->setRequired(true)
    	->setLabel('性别:')
    	->setMultiOptions(Model_Sex::getAll())
    	->addErrorMessage('不能为空 !')
    	->setSeparator('&nbsp;&nbsp;&nbsp;')
    	->removeDecorator('DtDdWrapper')
    	->removeDecorator('HtmlTag')
    	->removeDecorator('Label')
    	->removeDecorator('Errors');
    	
    	$dob = new Zend_Form_Element_Text('dob');
    	$dob->setAttrib('class', 'datepicker')
    	->setAttrib('size', '10')
    	->removeDecorator('HtmlTag')
    	->setRequired(true)
    	->addValidator('Date', false, array('format' => 'YYYY-mm-dd'))
    	->setLabel('出生日期 : ')
    	->addErrorMessage('不能为空 且格式是 YYYY-mm-dd !')
    	->removeDecorator('DtDdWrapper')
    	->removeDecorator('Label')
    	->removeDecorator('Errors');
    	
    	$tel = new Zend_Form_Element_Text('tel');
    	$tel->setLabel('联系电话:')
    	->setAttrib('size', 20)
    	->setAttrib('maxlength',30)
    	->addFilter('StringTrim')
    	->removeDecorator('HtmlTag')
    	->removeDecorator('DtDdWrapper')
    	->removeDecorator('Label')
    	->removeDecorator('Errors');
    	
    	$countries=Model_Country::getRows();
    	
    	$live = new Zend_Form_Element_Select('live');
    	$live->setMultiOptions($countries)
    	->setLabel('所在地区 : ')
    	->setRequired(true)
    	->addErrorMessage('不能为空 !')
    	->addFilter('StringTrim')
    	->removeDecorator('HtmlTag')
    	->removeDecorator('DtDdWrapper')
    	->removeDecorator('Label')
    	->removeDecorator('Errors');
    	
        $city = new Zend_Form_Element_Text('city');
        $city->setLabel('省/市 : ')
        	->setRequired(true)
        	 ->addErrorMessage('不能为空 !')
            ->setAttrib('size', 30)
            ->setAttrib('maxlength',30)
            ->removeDecorator('HtmlTag')
            ->removeDecorator('DtDdWrapper')
             ->removeDecorator('Label')
             ->removeDecorator('Errors');
        
        $height = new Zend_Form_Element_Text('height');
        $height->setLabel('身高 (单位cm): ')
        ->addValidator('Between',false, array(100,300))
        ->setAttrib('size', '5')
        ->setRequired(true)
        ->addValidator('Int')
        ->addErrorMessage('值必须为整数(0-300)!')
        ->addFilter('StringTrim')
        ->removeDecorator('HtmlTag')
        ->removeDecorator('DtDdWrapper')
        ->removeDecorator('Label')
        ->removeDecorator('Errors');
        
        $weight = new Zend_Form_Element_Text('weight');
        $weight->setLabel('体重 (单位kg): ')
        ->setAttrib('class', 'weight')
    //    ->setRequired(true)
        ->addValidator('Between',false, array(0,300))
        ->setAttrib('size', '5')
        ->addValidator('Int')
        ->addErrorMessage('值必须为整数(0-300)!')
        ->addFilter('StringTrim')
        ->removeDecorator('HtmlTag')
        ->removeDecorator('DtDdWrapper')
        ->removeDecorator('Label')
        ->removeDecorator('Errors');
        
        $ethic = new Zend_Form_Element_Select('ethic');
        $ethic->setMultiOptions(Model_Ethics::getAll())
        ->setLabel('祖籍: ')
        ->setRequired(true)
        ->addErrorMessage('不能为空 !')
        ->addFilter('StringTrim')
        ->removeDecorator('HtmlTag')
        ->removeDecorator('DtDdWrapper')
        ->removeDecorator('Label')
        ->removeDecorator('Errors');
        
        $rel = new Zend_Form_Element_Select('rel');
        $rel->setMultiOptions(Model_Religion::getAll())
        ->setLabel('信仰: ')
        ->setRequired(true)
        ->addErrorMessage('不能为空 !')
        ->addFilter('StringTrim')
        ->removeDecorator('HtmlTag')
        ->removeDecorator('DtDdWrapper')
        ->removeDecorator('Label')
        ->removeDecorator('Errors');
      /*  
        $appOpt=array('还可以','一般','好看','非常好看');
         
        $app = new Zend_Form_Element_Select('app');
        $app->setMultiOptions($appOpt)
        ->setLabel('外表: ')
        ->removeDecorator('HtmlTag')
        ->removeDecorator('DtDdWrapper')
        ->removeDecorator('Label')
        ->removeDecorator('Errors');
       */ 
        $drinkOpt=array(0=>'没有',1=>'有',2=>'有时候');
         
        $drink = new Zend_Form_Element_Select('drink');
        $drink->setMultiOptions($drinkOpt)
        ->setLabel('酗酒否: ')
        ->addFilter('StringTrim')
        ->removeDecorator('HtmlTag')
        ->removeDecorator('DtDdWrapper')
        ->removeDecorator('Label')
        ->removeDecorator('Errors');
        
        $smokeOpt=array(0=>'不抽烟',1=>'有时候',2=>'经常抽烟');
         
        $smoke = new Zend_Form_Element_Select('smoke');
        $smoke->setMultiOptions($smokeOpt)
        ->setLabel('吸烟否: ')
        ->addFilter('StringTrim')
        ->removeDecorator('HtmlTag')
        ->removeDecorator('DtDdWrapper')
        ->removeDecorator('Label')
        ->removeDecorator('Errors');
        
        $mar = new Zend_Form_Element_Select('mar');
        $mar->setMultiOptions(Model_Status::getAll())
        ->setLabel('婚姻状况: ')
        ->addFilter('StringTrim')
        ->removeDecorator('HtmlTag')
        ->removeDecorator('DtDdWrapper')
        ->removeDecorator('Label')
        ->removeDecorator('Errors');
        
        $childOpt=array(0=>'没有',1=>'有-不住家里',2=>'有-有时住在家里',3=>'有-住在家里');
         
        $child = new Zend_Form_Element_Select('child');
        $child->setMultiOptions($childOpt)
        ->setLabel('有无小孩: ')
        ->addFilter('StringTrim')
        ->removeDecorator('HtmlTag')
        ->removeDecorator('DtDdWrapper')
        ->removeDecorator('Label')
        ->removeDecorator('Errors');
        
        $pay = new Zend_Form_Element_Text('pay');
        $pay->setLabel('年收入: ')
        ->setAttrib('size', '10')
        ->addValidator('Int')
        ->addErrorMessage('值必须为整数!')
        ->addFilter('StringTrim')
        ->removeDecorator('HtmlTag')
        ->removeDecorator('DtDdWrapper')
        ->removeDecorator('Label')
        ->removeDecorator('Errors');
        
        $job = new Zend_Form_Element_Text('job');
        $job->setLabel('职业: ')
        ->setAttrib('class', 'job')
        ->setAttrib('size', '30')
        ->setRequired(true)
        ->addErrorMessage('不能为空 !')
        ->addFilter('StringTrim')
        ->removeDecorator('HtmlTag')
        ->removeDecorator('DtDdWrapper')
        ->removeDecorator('Label')
        ->removeDecorator('Errors');
        
        $country = new Zend_Form_Element_Select('country');
        $country->setMultiOptions($countries)
        ->setLabel('国籍: ')
        ->setRequired(true)
        ->addErrorMessage('不能为空 !')
        ->addFilter('StringTrim')
        ->removeDecorator('HtmlTag')
        ->removeDecorator('DtDdWrapper')
        ->removeDecorator('Label')
        ->removeDecorator('Errors');
        
        $edu = new Zend_Form_Element_Select('edu');
        $edu->setMultiOptions(Model_Education::getAll())
        ->setLabel('教育程度: ')
        ->addFilter('StringTrim')
        ->removeDecorator('HtmlTag')
        ->removeDecorator('DtDdWrapper')
        ->removeDecorator('Label')
        ->removeDecorator('Errors');
        
        $eng = new Zend_Form_Element_Select('eng');
        $eng->setMultiOptions(Model_English::getAll())
        ->setLabel('英语程度: ')
        ->addFilter('StringTrim')
        ->removeDecorator('HtmlTag')
        ->removeDecorator('DtDdWrapper')
        ->removeDecorator('Label')
        ->removeDecorator('Errors');
        
        $chinese = new Zend_Form_Element_Select('chinese');
        $chinese->setMultiOptions(Model_Chinese::getAll())
        ->setLabel('中文程度: ')
        ->addFilter('StringTrim')
        ->removeDecorator('HtmlTag')
        ->removeDecorator('DtDdWrapper')
        ->removeDecorator('Label')
        ->removeDecorator('Errors');
        
        
        $hobby = new Zend_Form_Element_Text('hobby');
        $hobby->setLabel('兴趣爱好: ')
        ->setAttrib('size', '50')
        ->addFilter('StringTrim')
        ->removeDecorator('HtmlTag')
        ->removeDecorator('DtDdWrapper')
        ->removeDecorator('Label')
        ->removeDecorator('Errors');
        
        $sx = new Zend_Form_Element_Select('sx');
        $sx->setMultiOptions(Model_Animal::getAll())
        ->setLabel('生肖: ')
        ->addFilter('StringTrim')
        ->removeDecorator('HtmlTag')
        ->removeDecorator('DtDdWrapper')
        ->removeDecorator('Label')
        ->removeDecorator('Errors');
        
        
        $star = new Zend_Form_Element_Select('star');
        $star->setMultiOptions(Model_Star::getAll())
        ->setLabel('星座: ')
        ->addFilter('StringTrim')
        ->removeDecorator('HtmlTag')
        ->removeDecorator('DtDdWrapper')
        ->removeDecorator('Label')
        ->removeDecorator('Errors');
    /*    
        $ads = new Zend_Form_Element_Select('ads');
        $ads->setMultiOptions(Model_Rate::getAll())
        ->setLabel('会员有效期: ')
        ->addFilter('StringTrim')
        ->removeDecorator('HtmlTag')
        ->removeDecorator('DtDdWrapper')
        ->removeDecorator('Label')
        ->removeDecorator('Errors');
   */     
        $title = new Zend_Form_Element_Text('title');
        $title->setLabel('简介(最多60字): ')
        ->setAttrib('size', 60)
        ->setAttrib('maxlength',60)
        ->setRequired(true)
        ->addErrorMessage('不能为空 !')
        ->removeDecorator('HtmlTag')
        // ->addFilter('StringTrim')
        ->removeDecorator('DtDdWrapper')
        ->removeDecorator('Label')
        ->removeDecorator('Errors');
        
        $content = new Zend_Form_Element_Textarea('editor');
        $content->setLabel('内心独白 : ')
        		->setRequired(true)
        		->addValidator('StringLength', false, array(1, 100000))
        		 ->addErrorMessage('不能为空 ，但不超过100000字符')
        		 ->setAttrib('COLS', '80')
        		 ->setAttrib('ROWS', '10')
        		->removeDecorator('DtDdWrapper')
             	->removeDecorator('Label')
             	->removeDecorator('Errors')
             	 ->removeDecorator('HtmlTag');
        
        $obj = new Zend_Form_Element_Textarea('obj');
        $obj->setLabel('理想伴侣   : ')
        ->setRequired(true)
        ->addValidator('StringLength', false, array(1, 20000))
        ->addErrorMessage('不能为空 ，但不超过20000字符')
        ->setAttrib('COLS', '80')
        ->setAttrib('ROWS', '4')
        ->removeDecorator('DtDdWrapper')
        ->removeDecorator('Label')
        ->removeDecorator('Errors')
        ->removeDecorator('HtmlTag');
  
        $photo = new Zend_Form_Element_File('photo');
        $photo->setLabel('个人头像  :')
        ->addValidator('Count', false, 1)
        ->addValidator(new Zend_Validate_File_ImageSize(array(
        		'minheight' => 150, 'minwidth' => 150,
        		'maxheight' =>200, 'maxwidth' =>200)))
        ->addValidator('Extension', false, 'jpg','png','gif','jpeg')
        ->addValidator('Size',false, array('max' =>'300Kb'))
        ->addErrorMessage('最大300KB，最小尺寸150X150px,最大尺寸200X200px')
        ->removeDecorator('DtDdWrapper')
        ->removeDecorator('Label')
        ->removeDecorator('Errors')
        ->removeDecorator('HtmlTag');
        
		$chkcode = new Zend_Form_Element_Text('chkcode');
       	$chkcode->setLabel('验证码 : ')
       			->setAttrib('size', '5')
       			 ->setAttrib('maxlength',5)
       			 ->setRequired(true)
       			  ->addErrorMessage('验证码不对!')
            	->removeDecorator('DtDdWrapper')
            	->removeDecorator('HtmlTag')
            	 ->removeDecorator('Label')
            	 ->removeDecorator('Errors');
             	
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'new_custmer')
            	->setLabel('提交')
            	->removeDecorator('HtmlTag')
            	->removeDecorator('Label')
            	->removeDecorator('Errors')
            	->removeDecorator('DtDdWrapper');
        
        $this->addElements(array($name,$lname,$email,$pwd,$sex,$dob,$tel,$live,$city,
        		$height,$weight,$ethic,$rel,$drink,$smoke,$mar,$child,$pay,
        		$job,$country,$edu,$eng,$chinese,$hobby,
        		$sx,$star,$title,$content,$obj,$photo,$chkcode,$submit));
	 }
	 
	  function __toString() 	{
	 	
	 	$this->render();
	 	
		$result = '<form enctype="multipart/form-data" method="post" action="">';
		
		$result .= "<table class='bigform'>";
		
		$result .= '<tr><td class="label_c1 required">电邮 : </td><td class="field_c2">' .$this->getElement("email")->__toString().'<span class="c3txt required"> 登录密码：</span>'.$this->getElement("pwd")->__toString().'</td></tr>';
		
		$result .= '<tr><td class="label_c1 required">名字 : </td><td class="field_c2">'.$this->getElement("name")->__toString().'<span class="c3txt required">姓：</span>'.$this->getElement("lname")->__toString().
		'<span class="c3txt required">出生日期 (YYYY-mm-dd) ：</span>'.$this->getElement("dob")->__toString().'</td></tr>';
		
    	$result .= '<tr><td class="label_c1 required">性别: </td><td class="field_c2">&nbsp;' .$this->getElement("sex")->__toString().'<span class="c3txt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;联系电话 ： </span>'.$this->getElement("tel")->__toString().'</td></tr>';
		
		$result .= '<tr><td class="label_c1 required">所在地区 : </td><td class="field_c2">' .$this->getElement("live")->__toString().'<span class="c3txt required">城市 :</span>'.$this->getElement("city")->__toString().'</td></tr>';
		
		$result .= '<tr><td class="label_c1 required">身高 (cm): </td><td class="field_c2">' .$this->getElement("height")->__toString().
		'<span class="c3txt">体重 (kg):</span>'.$this->getElement("weight")->__toString().
		'<span class="c3txt required">生肖:</span>'.
		$this->getElement("sx")->__toString().'<span class="c3txt required">星座:</span>'.$this->getElement("star")->__toString().
		'</td></tr>';
		
		$result .= '<tr><td class="label_c1 required">祖籍: </td><td class="field_c2">' .$this->getElement("ethic")->__toString().'<span class="c3txt required">信仰:</span>'.$this->getElement("rel")->__toString().'<span class="c3txt required">国籍: </span>'.$this->getElement("country")->__toString().'</td></tr>';
		$result .= '<tr><td class="label_c1 required">酗酒否: </td><td class="field_c2">' .$this->getElement("drink")->__toString().'<span class="c3txt required">吸烟否:</span>'.$this->getElement("smoke")->__toString().'</td></tr>';
		$result .= '<tr><td class="label_c1 required">婚姻状况: </td><td class="field_c2">' .$this->getElement("mar")->__toString().'<span class="c3txt required">有无小孩:</span>'.$this->getElement("child")->__toString().'</td></tr>';
		$result .= '<tr><td class="label_c1">年收入(人民币): </td><td class="field_c2">' .$this->getElement("pay")->__toString().'<span class="c3txt required">职业: </span>'.$this->getElement("job")->__toString().'</td></tr>';

		$result .= '<tr><td class="label_c1 required">教育程度:  </td><td class="field_c2">' .$this->getElement("edu")->__toString().'<span class="c3txt required">中文程度:</span>'.$this->getElement("chinese")->__toString().'</td></tr>';
		
		$result .= '<tr><td class="label_c1 required">英语程度:  </td><td class="field_c2">' .$this->getElement("eng")->__toString().'<span class="c3txt">兴趣爱好:</span>'.$this->getElement("hobby")->__toString().'</td></tr>';
		
	//	$result .= '<tr><td class="label_c1 required">会员有效期:  </td><td class="field_c2">' .$this->getElement("ads")->__toString().'</td></tr>';
		
		$result .= '<tr><td class="label_c1 required">简介(最多60字): </td><td class="field_c2">' .$this->getElement("title")->__toString().'</td></tr>';
		
		$result .= '<tr><td class="label_c1 required">内心独白 : </td><td class="field_c2">' .$this->getElement("editor")->__toString().'</td></tr>';
		
		$result .= '<tr><td class="label_c1 required">理想伴侣  : </td><td class="field_c2">' .$this->getElement("obj")->__toString().'</td></tr>';
		
		
		$result .= '<tr><td class="label_c1">个人头像  :</td><td class="field_c2">' .$this->getElement("photo")->__toString().'</td></tr>';	
		
		$result .= '<tr><td class="label_c1"></td><td class="field_c2">'.'<span class="alert">头像最大为300KB，最小尺寸150X150px，最大尺寸200X200px (格式：jpg,jpeg,png,或gif) !</span></td></tr>';
		

		$result .= '<tr><td class="label_c1 required">验证码 : </td><td class="field_c2">' . $this->getElement('chkcode')."<span class='verify'><img src='/image.php' /></span>".'</td></tr>';
//		$result .= '<tr><td class="label_c1"></td><td class="field_c2 terms"><span class="alert">点击提交，表明您已承诺所粘贴信息符合相关法律规定并接受本站用户条约。</span>' . '</td></tr>';
  
		$result .= '<tr><td class="label_c1"></td><td class="field_c2"></td></tr>';
    	$result .= '<tr><td class="label_c1"></td><td class="field_c2">'.$this->getElement('submit'). '<span class="alert">(点击提交，表明您已接受本站用户条约。)</span>'.
    	'</td></tr>';
		$result .= '</table></form>';
    	return $result;
	} 
	 
	public function isValid($data)
	{
		$valid = parent::isValid($data);
		if (!$valid) {return $valid;}
		$date1=$this->getValue('dob');
		
		$newemail=$this->getValue('email');
		
		if (!Zend_Date::isDate($date1,'YYYY-MM-dd')) {
        	$valid = false;
        	$this->start->addError('日期格式不对 !');
		}
		
		if (Model_Member::getUserByEmail($newemail)){
			$valid = false;
			$this->email->addError('邮箱已存在 !');
		}
				
		$chk=$this->getValue('chkcode');
		if ($_SESSION['check_pic']!=$chk) {
        	$valid = false;
        	$this->chkcode->addError('验证码不对 !');
		}
        return $valid;
	}
	
}
