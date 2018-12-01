<?php
/**

*/
class Caclass_Form extends Zend_Form
{
	public function __construct($options = null)
	{
		parent::__construct($options);
	}

	public function displayErrorBox($box_title = ''){
		 
		$message = $box_title;
		// use the forms translator for the summary message
		$translator = $this->getTranslator();
		if ($translator !== null){
			$message = $translator->translate($message);
		}

		$view = $this->getView();
		if (null === $view) {
			return ;
		}
		 
		$message = $box_title;
		if (empty($box_title)){
			$message = '';
		}

		$errors  = $this->getMessages();
		 
		$custom_errors = $this->getErrorMessages();
		 
		if (empty($errors) && empty($custom_errors)) {
			return '';
		}


		$markup = '<div class="ui-widget all-errors" style="padding-bottom:10px"><div style="padding: 0.7em 0.7em;" class="ui-state-error ui-corner-all"> ';
		if (!empty($message)){
			$markup .= '<p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-alert"></span>
				<strong>Alert:</strong> ' . $message . '</p>';
		}
		$markup .= '<ul style="padding-left:20px">';

		/*
		 for($i=0;$i<count($custom_errors);$i++){
		 $markup .= '<li><span class="label"></span>'
		 . $custom_errors[$i] . '</li>';
		 }
		 */

		foreach ($errors as $name => $list) {
			$element = $this->$name;

			if($element instanceof Zend_Form_Element) {
				$label = $element->getLabel();
				if (empty($label)) {
					$label = $element->getName();
				}
				$label = trim($label);
				if (empty($label)) {
					$label = '';
				}
				if (null !== ($translator = $element->getTranslator())) {
					$label = $translator->translate($label);
				}

				$error_msg = '';
				foreach ($list as $key => $error) {
					$error_msg = $view->escape($error);
					break; // just do the first error message for a field
				}

				$markup .= '<li>' . $label . ' '
				. $error_msg . '</li>';
				 
			}
			else{
				if (is_string($list)){
					$markup .= '<li>' . $list . '</li>';
				}elseif(is_array($list)){
					foreach($list as $f => $v){
						$new_v = array_values($v);
						for($i=0;$i<count($new_v);$i++){
							$markup .= '<li>' . $new_v[$i] . '</li>';
						}
					}
				}
			}
		}

		$markup .= '</ul></div></div>';

		return $markup;
	}

}
