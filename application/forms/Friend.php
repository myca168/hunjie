<?php
/**
 * 
 * @Form for ads custoemrs
 *
 */

class Form_Friend extends Zend_Form {
	
    public function init() {
    	
    	$dname = new Zend_Form_Element_Text('dname');
        $dname->setLabel('Site Name : ')
            ->setAttrib('size', '40')
            ->setAttrib('maxlength',40)
            ->setRequired(true)
            ->addErrorMessage('不能为空 !')
            ->removeDecorator('HtmlTag');
        
        $link = new Zend_Form_Element_Text('link');
        $link->setLabel('Site(www.xxxxx.yyy) :')
            ->setAttrib('size', '60')
            ->setRequired(true)
           ->addValidator('Hostname')
         //   ->addErrorMessage('格式不对!')
            ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag');
        
        $sqn = new Zend_Form_Element_Text('sqn');
        $sqn->setLabel('Order : ')
        	 ->setAttrib('class', 'sqn')
        	 ->addValidator('Between',false, array(1,99)) 
        	 ->setRequired(true)
        	 ->setAttrib('size', '3')
        	 ->addValidator('Int') 
            ->addFilter('StringTrim')
            ->removeDecorator('HtmlTag'); 
            
        $desc = new Zend_Form_Element_Text('desc');
        $desc->setLabel('Notes : ')
            ->setAttrib('size', '60')
            ->setAttrib('maxlength',250)
            ->removeDecorator('HtmlTag');    
            
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'new_custmer')
            	->setLabel('Submit');
            //	->removeDecorator('DtDdWrapper');
        
        $this->addElements(array($dname,$link,$sqn,$desc,$submit));
        
	    }
	    
}
