<?php
/*
** Instead of creating tables, we use simple class to define some constant data
*/
class Caclass_Consts {
	public static function ethics() {
		return array(1=>'亚洲人',2=>'白人',3=>'中东人',4=>'印度人',5=>'太平洋岛民',6=>'拉丁裔',7=>'混血',
				8=>'黑人',9=>'其他');
	}
	
	public static function religion() {
		return array(1=>'没什么信仰',2=>'佛教',3=>'天主教',4=>'基督教',5=>'新教徒',6=>'印度教',
				7=>'伊斯兰教',8=>'犹太教',9=>'东正教',10=>'其他');
	}
	//return the number of floors
	public static function Floors() {
		return array(1=>'1',2=>'1.5', 3=>'2',4=>'2.5',5=>'3',6=>'3.5',7=>'> 3.5');
	}
	
	//return the description of floors for rent
	public static function FloorDesc() {
		return array(1=>'地下室',2=>'一楼', 3=>'二楼',4=>'三楼',5=>'四楼',6=>'>四楼',7=>'整套');
	}
	
	public static function Ages() {
		return array(0=>'新',1=>'0 - 5 年',2=>'6 - 15 年', 3=>'16 - 30 年',4=>'31 - 50 年',
       								5=>'51 - 99 年',6=>'> 99 年');
	}
	/*
	public static function Terms() {
		return array(1=>'1 Week',2=>'2 Weeks',3=>'3 Weeks', 4=>'1 Month',5=>'2 Months',6=>'3 Months');
	}
	*/
}