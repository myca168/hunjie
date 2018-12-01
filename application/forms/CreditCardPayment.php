<?php
class Form_CreditCardPayment extends Caclass_Form
{
	public function __construct($options = null)
	{
		parent::__construct($options);

		$this->setName('Credit Card Payment')
		->setMethod('post');

		$fname=new Zend_Form_Element_Text('fname');
		$fname->setAttrib('size','35')
		->addValidator('NotEmpty',true,array('messages'=>array('isEmpty'=>'First Name can not be empty')))
		->setRequired(true)
		->addFilter('StringTrim')
		->addFilter('StripTags')
		->setLabel('First Name :')
		 ->removeDecorator('HtmlTag')
         ->removeDecorator('DtDdWrapper')
         ->removeDecorator('Label')
         ->removeDecorator('Errors');

		$lname=new Zend_Form_Element_Text('lname');
		$lname->setAttrib('size','35')
		->addValidator('NotEmpty',true,array('messages'=>array('isEmpty'=>'Last Name can not be empty')))
		->setRequired(true)
		->addFilter('StringTrim')
		->addFilter('StripTags')
		->setLabel('Last Name :')
		 ->removeDecorator('HtmlTag')
         ->removeDecorator('DtDdWrapper')
         ->removeDecorator('Label')
         ->removeDecorator('Errors') ;

        $card_type_list=array('VI'=>'Visa','MC'=>'MasterCard');
		$card_type=new Zend_Form_Element_Select('cardType');
		$card_type->addMultiOptions($card_type_list)
		->setRequired(true)
		->setLabel('Card Type :')
		 ->removeDecorator('HtmlTag')
         ->removeDecorator('DtDdWrapper')
         ->removeDecorator('Label')
         ->removeDecorator('Errors') ;

		$cardNumber=new Zend_Form_Element_Text('cardNumber');
		$cardNumber->setAttrib('size','35')
		->addValidator('NotEmpty',true,array('messages'=>array('isEmpty'=>'Card Number can not be empty')))
		->setRequired(true)
		->addFilter('StringTrim')
		->addFilter('StripTags')
		->setLabel('Card # :')
		 ->removeDecorator('HtmlTag')
            ->removeDecorator('DtDdWrapper')
            ->removeDecorator('Label')
            ->removeDecorator('Errors') ;

		$monthExp_list=array("01"=>"01","02"=>"02","03"=>"03","04"=>"04","05"=>"05","06"=>"06","07"=>"07","08"=>"08","09"=>"09","10"=>"10","11"=>"11","12"=>"12");

		$monthExp=new Zend_Form_Element_Select('monthExp');
		$monthExp->addMultiOptions($monthExp_list)
		->setRequired(true)
		 ->removeDecorator('HtmlTag')
            ->removeDecorator('DtDdWrapper')
            ->removeDecorator('Label')
            ->removeDecorator('Errors') ;

		$yearExp_list=array();
		$yearExp_list['']='--';
		for($i=14;$i<34;$i++)
		{
			$yearExp_list[$i]=$i;
		}

		$yearExp=new Zend_Form_Element_Select('yearExp');
		$yearExp->addMultiOptions($yearExp_list)
		->setRequired(true)
		 ->removeDecorator('HtmlTag')
		 ->setLabel('Expired Date :')
            ->removeDecorator('DtDdWrapper')
            ->removeDecorator('Label')
            ->removeDecorator('Errors') ;

		$cvdValue=new Zend_Form_Element_Text('cvdValue');
		$cvdValue->setAttrib('size','10')
		->addValidator('NotEmpty',true,array('messages'=>array('isEmpty'=>'Value can not be empty')))
		->setRequired(true)
		->addFilter('StringTrim')
		->setLabel('Verification # :')
		->addFilter('StripTags')
		 ->removeDecorator('HtmlTag')
            ->removeDecorator('DtDdWrapper')
            ->removeDecorator('Label')
            ->removeDecorator('Errors') ;

		$streetAddr=new Zend_Form_Element_Text('streetAddr');
		$streetAddr->setAttrib('size','50')
		->addValidator('NotEmpty',true,array('messages'=>array('isEmpty'=>'Address can not be empty')))
		->setRequired(true)
		->addFilter('StringTrim')
		->addFilter('StripTags')
		->setLabel('Address :')
		 ->removeDecorator('HtmlTag')
            ->removeDecorator('DtDdWrapper')
            ->removeDecorator('Label')
            ->removeDecorator('Errors') ;

		$streetAddr2=new Zend_Form_Element_Text('streetAddr2');
		$streetAddr2->setAttrib('size','35')
		->addFilter('StringTrim')
		->addFilter('StripTags')
		 ->removeDecorator('HtmlTag')
            ->removeDecorator('DtDdWrapper')
            ->removeDecorator('Label')
            ->removeDecorator('Errors') ;

		$city=new Zend_Form_Element_Text('city');
		$city->setAttrib('size','35')
		->addValidator('NotEmpty',true,array('messages'=>array('isEmpty'=>'City can not be empty')))
		->setRequired(true)
		->addFilter('StringTrim')
		->addFilter('StripTags')
		->setLabel('City :')
		 ->removeDecorator('HtmlTag')
            ->removeDecorator('DtDdWrapper')
            ->removeDecorator('Label')
            ->removeDecorator('Errors') ;

		$province_list=array(			""=>"<-----Select----->",
                                        "--"=>"Outside U.S./Canada",
                                        "AB"=>"Alberta",

                                        "AK"=>"Alaska",
                                        "AL"=>"Alabama",
                                        "AR"=>"Arkansas",
                                        "AZ"=>"Arizona",
                                        "BC"=>"British Columbia",
                                        "CA"=>"California",

                                        "CO"=>"Colorado",
                                        "CT"=>"Connecticut",
                                        "DC"=>"District of Columbia",
                                        "DE"=>"Delaware",
                                        "FL"=>"Florida",
                                        "GA"=>"Georgia",

                                        "HI"=>"Hawaii",
                                        "IA"=>"Iowa",
                                        "ID"=>"Idaho",
                                        "IL"=>"Illinois",
                                        "IN"=>"Indiana",
                                        "KS"=>"Kansas",

                                        "KY"=>"Kentucky",
                                        "LA"=>"Louisiana",
                                        "MA"=>"Massachusetts",
                                        "MB"=>"Manitoba",
                                        "MD"=>"Maryland",
                                        "ME"=>"Maine",

                                        "MI"=>"Michigan",
                                        "MN"=>"Minnesota",
                                        "MO"=>"Missouri",
                                        "MS"=>"Mississippi",
                                        "MT"=>"Montana",
                                        "NB"=>"New Brunswick",

                                        "NC"=>"North Carolina",
                                        "ND"=>"North Dakota",
                                        "NE"=>"Nebraska",
                                        "NF"=>"Newfoundland",
                                        "NH"=>"New Hampshire",
                                        "NJ"=>"New Jersey",

                                        "NM"=>"New Mexico",
                                        "NS"=>"Nova Scotia",
                                        "NT"=>"Northwest Territories",
                                        "NV"=>"Nevada",
                                        "NY"=>"New York",
                                        "OH"=>"Ohio",

                                        "OK"=>"Oklahoma",
                                        "ON"=>"Ontario",
                                        "OR"=>"Oregon",
                                        "PA"=>"Pennsylvania",
                                        "PE"=>"Prince Edward Island",
                                        "QC"=>"Quebec",

                                        "RI"=>"Rhode Island",
                                        "SC"=>"South Carolina",
                                        "SD"=>"South Dakota",
                                        "SK"=>"Saskatchewan",
                                        "TN"=>"Tennessee",
                                        "TX"=>"Texas",

                                        "UT"=>"Utah",
                                        "VA"=>"Virginia",
                                        "VT"=>"Vermont",
                                        "WA"=>"Washington",
                                        "WI"=>"Wisconsin",
                                        "WV"=>"West Virginia",

                                        "WY"=>"Wyoming",
                                        "YT"=>"Yukon",
		);
		$province=new Zend_Form_Element_Select('province');
		$province->addMultiOptions($province_list)
		 ->removeDecorator('HtmlTag')
		 ->setLabel('State/Province :')
		 ->setRequired(true)
            ->removeDecorator('DtDdWrapper')
            ->removeDecorator('Label')
            ->removeDecorator('Errors') ;

		$countrylist=array(				null=>"<-----Select----->",
                                        "AF"=>"Afghanistan",
                                        "AL"=>"Albania",
                                        "DZ"=>"Algeria",

                                        "AS"=>"American Samoa",
                                        "AD"=>"Andorra",
                                        "AO"=>"Angola",
                                        "AI"=>"Anguilla",
                                        "AQ"=>"Antarctica",
                                        "AG"=>"Antigua and Barbuda",

                                        "AR"=>"Argentina",
                                        "AM"=>"Armenia",
                                        "AW"=>"Aruba",
                                        "AP"=>"Asia/Pacific Region",
                                        "AU"=>"Australia",
                                        "AT"=>"Austria",

                                        "AZ"=>"Azerbaijan",
                                        "BS"=>"Bahamas",
                                        "BH"=>"Bahrain",
                                        "BD"=>"Bangladesh",
                                        "BB"=>"Barbados",
                                        "BY"=>"Belarus",

                                        "BE"=>"Belgium",
                                        "BZ"=>"Belize",
                                        "BJ"=>"Benin",
                                        "BM"=>"Bermuda",
                                        "BT"=>"Bhutan",
                                        "BO"=>"Bolivia",

                                        "BA"=>"Bosnia and Herzegovina",
                                        "BW"=>"Botswana",
                                        "BV"=>"Bouvet Island",
                                        "BR"=>"Brazil",
                                        "IO"=>"British Indian Ocean Territory",
                                        "BN"=>"Brunei Darussalam",

                                        "BG"=>"Bulgaria",
                                        "BF"=>"Burkina Faso",
                                        "BI"=>"Burundi",
                                        "KH"=>"Cambodia",
                                        "CM"=>"Cameroon",
                                        "CA"=>"Canada",

                                        "CV"=>"Cape Verde",
                                        "KY"=>"Cayman Islands",
                                        "CF"=>"Central African Republic",
                                        "TD"=>"Chad",
                                        "CL"=>"Chile",
                                        "CN"=>"China",

                                        "CX"=>"Christmas Island",
                                        "CC"=>"Cocos (Keeling) Islands",
                                        "CO"=>"Colombia",
                                        "KM"=>"Comoros",
                                        "CG"=>"Congo",
                                        "CD"=>"Congo, The Democratic Republic of the",

                                        "CK"=>"Cook Islands",
                                        "CR"=>"Costa Rica",
                                        "CI"=>"Cote D'Ivoire",
                                        "HR"=>"Croatia",
                                        "CU"=>"Cuba",
                                        "CY"=>"Cyprus",

                                        "CZ"=>"Czech Republic",
                                        "DK"=>"Denmark",
                                        "DJ"=>"Djibouti",
                                        "DM"=>"Dominica",
                                        "DO"=>"Dominican Republic",
                                        "TP"=>"East Timor",

                                        "EC"=>"Ecuador",
                                        "EG"=>"Egypt",
                                        "SV"=>"El Salvador",
                                        "GQ"=>"Equatorial Guinea",
                                        "ER"=>"Eritrea",
                                        "EE"=>"Estonia",

                                        "ET"=>"Ethiopia",
                                        "EU"=>"Europe",
                                        "FK"=>"Falkland Islands (Malvinas)",
                                        "FO"=>"FaroeIslands",
                                        "FJ"=>"Fiji",
                                        "FI"=>"Finland",

                                        "FR"=>"France",
                                        "FX"=>"France, Metropolitan",
                                        "GF"=>"French Guiana",
                                        "PF"=>"French Polynesia",
                                        "TF"=>"French Southern Territories",
                                        "GA"=>"Gabon",

                                        "GM"=>"Gambia",
                                        "GE"=>"Georgia",
                                        "DE"=>"Germany",
                                        "GH"=>"Ghana",
                                        "GI"=>"Gibraltar",
                                        "GR"=>"Greece",

                                        "GL"=>"Greenland",
                                        "GD"=>"Grenada",
                                        "GP"=>"Guadeloupe",
                                        "GU"=>"Guam",
                                        "GT"=>"Guatemala",
                                        "GN"=>"Guinea",

                                        "GW"=>"Guinea-Bissau",
                                        "GY"=>"Guyana",
                                        "HT"=>"Haiti",
                                        "HM"=>"Heard Island and McDonald Islands",
                                        "VA"=>"Holy See (Vatican City State)",
                                        "HN"=>"Honduras",

                                        "HK"=>"Hong Kong",
                                        "HU"=>"Hungary",
                                        "IS"=>"Iceland",
                                        "IN"=>"India",
                                        "ID"=>"Indonesia",
                                        "IR"=>"Iran, Islamic Republic of",

                                        "IQ"=>"Iraq",
                                        "IE"=>"Ireland",
                                        "IL"=>"Israel",
                                        "IT"=>"Italy",
                                        "JM"=>"Jamaica",
                                        "JP"=>"Japan",

                                        "JO"=>"Jordan",
                                        "KZ"=>"Kazakstan",
                                        "KE"=>"Kenya",
                                        "KI"=>"Kiribati",
                                        "KP"=>"Korea, Democratic People's Republic of",
                                        "KR"=>"Korea, Republic of",

                                        "KW"=>"Kuwait",
                                        "KG"=>"Kyrgyzstan",
                                        "LA"=>"Lao People's Democratic Republic",
                                        "LV"=>"Latvia",
                                        "LB"=>"Lebanon",
                                        "LS"=>"Lesotho",

                                        "LR"=>"Liberia",
                                        "LY"=>"Libyan Arab Jamahiriya",
                                        "LI"=>"Liechtenstein",
                                        "LT"=>"Lithuania",
                                        "LU"=>"Luxembourg",
                                        "MO"=>"Macau",

                                        "MK"=>"Macedonia, the Former Yugoslav Republic of",
                                        "MG"=>"Madagascar",
                                        "MW"=>"Malawi",
                                        "MY"=>"Malaysia",
                                        "MV"=>"Maldives",
                                        "ML"=>"Mali",

                                        "MT"=>"Malta",
                                        "MH"=>"Marshall Islands",
                                        "MQ"=>"Martinique",
                                        "MR"=>"Mauritania",
                                        "MU"=>"Mauritius",
                                        "YT"=>"Mayotte",

                                        "MX"=>"Mexico",
                                        "FM"=>"Micronesia, Federated States of",
                                        "MD"=>"Moldova, Republic of",
                                        "MC"=>"Monaco",
                                        "MN"=>"Mongolia",
                                        "MS"=>"Montserrat",

                                        "MA"=>"Morocco",
                                        "MZ"=>"Mozambique",
                                        "MM"=>"Myanmar",
                                        "NA"=>"Namibia",
                                        "NR"=>"Nauru",
                                        "NP"=>"Nepal",

                                        "NL"=>"Netherlands",
                                        "AN"=>"Netherlands Antilles",
                                        "NC"=>"New Caledonia",
                                        "NZ"=>"New Zealand",
                                        "NI"=>"Nicaragua",
                                        "NE"=>"Niger",

                                        "NG"=>"Nigeria",
                                        "NU"=>"Niue",
                                        "NF"=>"Norfolk Island",
                                        "MP"=>"Northern Mariana Islands",
                                        "NO"=>"Norway",
                                        "OM"=>"Oman",

                                        "PK"=>"Pakistan",
                                        "PW"=>"Palau",
                                        "PS"=>"Palestinian Territory, Occupied",
                                        "PA"=>"Panama",
                                        "PG"=>"Papua New Guinea",
                                        "PY"=>"Paraguay",

                                        "PE"=>"Peru",
                                        "PH"=>"Philippines",
                                        "PN"=>"Pitcairn",
                                        "PL"=>"Poland",
                                        "PT"=>"Portugal",
                                        "PR"=>"Puerto Rico",

                                        "QA"=>"Qatar",
                                        "RE"=>"Reunion",
                                        "RO"=>"Romania",
                                        "RU"=>"Russian Federation",
                                        "RW"=>"Rwanda",
                                        "SH"=>"Saint Helena",

                                        "KN"=>"Saint Kitts and Nevis",
                                        "LC"=>"Saint Lucia",
                                        "PM"=>"Saint Pierre and Miquelon",
                                        "VC"=>"Saint Vincent and the Grenadines",
                                        "WS"=>"Samoa",
                                        "SM"=>"San Marino",

                                        "ST"=>"Sao Tome and Principe",
                                        "SA"=>"Saudi Arabia",
                                        "SN"=>"Senegal",
                                        "CS"=>"Serbia and Montenegro",
                                        "SC"=>"Seychelles",
                                        "SL"=>"Sierra Leone",

                                        "SG"=>"Singapore",
                                        "SK"=>"Slovakia",
                                        "SI"=>"Slovenia",
                                        "SB"=>"Solomon Islands",
                                        "SO"=>"Somalia",
                                        "ZA"=>"South Africa",

                                        "GS"=>"South Georgia and the South Sandwich Islands",
                                        "ES"=>"Spain",
                                        "LK"=>"Sri Lanka",
                                        "SD"=>"Sudan",
                                        "SR"=>"Suriname",
                                        "SJ"=>"Svalbard and Jan Mayen",

                                        "SZ"=>"Swaziland",
                                        "SE"=>"Sweden",
                                        "CH"=>"Switzerland",
                                        "SY"=>"Syrian Arab Republic",
                                        "TW"=>"Taiwan",
                                        "TJ"=>"Tajikistan",

                                        "TZ"=>"Tanzania, United Republic of",
                                        "TH"=>"Thailand",
                                        "TG"=>"Togo",
                                        "TK"=>"Tokelau",
                                        "TO"=>"Tonga",
                                        "TT"=>"Trinidad and Tobago",

                                        "TN"=>"Tunisia",
                                        "TR"=>"Turkey",
                                        "TM"=>"Turkmenistan",
                                        "TC"=>"Turks and Caicos Islands",
                                        "TV"=>"Tuvalu",
                                        "UG"=>"Uganda",

                                        "UA"=>"Ukraine",
                                        "AE"=>"United Arab Emirates",
                                        "GB"=>"United Kingdom",
                                        "US"=>"United States",
                                        "UM"=>"United States Minor Outlying Islands",
                                        "UY"=>"Uruguay",

                                        "UZ"=>"Uzbekistan",
                                        "VU"=>"Vanuatu",
                                        "VE"=>"Venezuela",
                                        "VN"=>"Vietnam",
                                        "VG"=>"Virgin Islands, British",
                                        "VI"=>"Virgin Islands, U.S.",

                                        "WF"=>"Wallis and Futuna",
                                        "EH"=>"Western Sahara",
                                        "YE"=>"Yemen",
                                        "YU"=>"Yugoslavia",
                                        "ZR"=>"Zaire",
                                        "ZM"=>"Zambia",

                                        "ZW"=>"Zimbabwe",
		);

		$country=new Zend_Form_Element_Select('country');
		$country->setRequired(true)
		->addMultiOptions($countrylist)
		->addValidator('NotEmpty',true)
		 ->removeDecorator('HtmlTag')
		 ->setLabel('Country :')
            ->removeDecorator('DtDdWrapper')
            ->removeDecorator('Label')
            ->removeDecorator('Errors') ;

		$zip_code=new Zend_Form_Element_Text('zip');
		$zip_code->setAttrib('size','15')
		->setRequired(true)
		->setLabel('Zip Code :')
		->addFilter('StringTrim')
		->addFilter('StripTags')
		 ->removeDecorator('HtmlTag')
            ->removeDecorator('DtDdWrapper')
            ->removeDecorator('Label')
            ->removeDecorator('Errors') ;

		$phone=new Zend_Form_Element_Text('phone');
		$phone->setAttrib('size','35')
		->addValidator('NotEmpty',true,array('messages'=>array('isEmpty'=>'Phone can not be empty')))
		->setRequired(true)
		->setLabel('Phone :')
		->addFilter('StringTrim')
		->addFilter('StripTags')
		 ->removeDecorator('HtmlTag')
            ->removeDecorator('DtDdWrapper')
            ->removeDecorator('Label')
            ->removeDecorator('Errors') ;

		$email=new Zend_Form_Element_Text('email');
		$email->setAttrib('size','35')
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty',true,array('messages'=>array('isEmpty'=>'Email can not be empty')))
		->addValidator('EmailAddress')
		->setLabel('Email :')
		->setRequired(true)
		 ->removeDecorator('HtmlTag')
            ->removeDecorator('DtDdWrapper')
            ->removeDecorator('Label')
            ->removeDecorator('Errors') ;

		$submit=new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Pay Now')
		 ->removeDecorator('HtmlTag')
            ->removeDecorator('Label')
            ->removeDecorator('DtDdWrapper')
            ->removeDecorator('Errors');

		/*
		$card=new Zend_Form_Element_Image('creditcard');
		$card->setImage('/images/creditcard.jpg')
		->setValue('CreditCard');
		$this->addElement($card);
		*/
	     $this->addElements(array($fname,$lname,$card_type,$cardNumber,$monthExp,$yearExp,$cvdValue,
	     $streetAddr,$streetAddr2,$city,$province,$country,$zip_code,$phone,$email,$submit));
 	  }
	    
	  function __toString() {
	 	
		$result = '<form enctype="multipart/form-data" method="post" action="">';

		$result .= "<table class='bigform'>";
		$result .= '<tr><td class="label_c1 required">名字 : </td><td class="field_c2">' .$this->getElement("fname")->__toString().'</td></tr>';
		$result .= '<tr><td class="label_c1 required">姓 : </td><td class="field_c2">' .$this->getElement("lname")->__toString().'</td></tr>';
	//	$result .= '<tr><td class="label_c1 required">Currency : </td><td class="field_c2">' .$this->getElement("currency")->__toString().'</td></tr>';
		$result .= '<tr><td class="label_c1 required">信用卡 : </td><td class="field_c2">' .$this->getElement("cardType")->__toString().'</td></tr>';	
		$result .= '<tr><td class="label_c1 required">信用卡号 : </td><td class="field_c2">' .$this->getElement("cardNumber")->__toString().'</td></tr>';
		$result .= '<tr><td class="label_c1 required">有效期:  </td><td class="field_c2">' .$this->getElement("monthExp")->__toString().'月'.$this->getElement("yearExp")->__toString().'年</td></tr>';
		$result .= '<tr><td class="label_c1 required">确认码  : </td><td class="field_c2">' .$this->getElement("cvdValue")->__toString().'</td></tr>';
		$result .= '<tr><td class="label_c1 required">地址 : </td><td class="field_c2">' .$this->getElement("streetAddr")->__toString().'</td></tr>';	
		$result .= '<tr><td class="label_c1">地址 (可选) : </td><td class="field_c2">' .$this->getElement("streetAddr2")->__toString().'</td></tr>';
		$result .= '<tr><td class="label_c1 required">城市 : </td><td class="field_c2">' .$this->getElement("city")->__toString().'</td></tr>';
		$result .= '<tr><td class="label_c1 required">省/州 : </td><td class="field_c2">' .$this->getElement("province")->__toString().'</td></tr>';
		$result .= '<tr><td class="label_c1 required">国家 : </td><td class="field_c2">' .$this->getElement("country")->__toString().'</td></tr>';
		$result .= '<tr><td class="label_c1 required">邮编 : </td><td class="field_c2">' .$this->getElement("zip")->__toString().'</td></tr>';	
		$result .= '<tr><td class="label_c1 required">电话 : </td><td class="field_c2">' .$this->getElement("phone")->__toString().'</td></tr>';
		$result .= '<tr><td class="label_c1 required">电邮  : </td><td class="field_c2">' .$this->getElement("email")->__toString().'</td></tr>';
    	$result .= '<tr><td class="label_c1"><img src="/images/creditcard.jpg" /></td><td class="field_c2">'.$this->getElement('submit').'</td></tr>';
		$result .= '</table></form>';
    	return $result;
	} 
	
}