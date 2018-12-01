<?php
class Model_Site extends Zend_Db_Table_Abstract {
	/**
	 * The default table name
	 */
	protected $_name = 'site';
	//protected $_primary = 'id'; ==> Do not need to define the primary key even the field name is not 'id'
	
	const SITE_FIRM = 'company';
	const SITE_ONLINE = 'online';
	const SITE_KEYWORDS = 'keywords';
	const SITE_DESC = 'description';
	const SITE_DOMAIN = 'domain';
	const SITE_WEBMASTER = 'webmaster';
	const SITE_SALES = 'sales';
	const SITE_ADS = 'ads';
	const SITE_BILLINGS = 'billings';
	const SITE_TEL = 'tel';
	const SITE_FAX = 'fax';
	const SITE_DEFAULT_FLAG = 99;
	const SITE_ON_TOP_FLAG = 80;
	const SITE_DEFAULT_SQN = 1;
	const SITE_ON_TOP_SQN = 2;

        //should use the following constants
        const EMAIL_SERVER = "mail.caclass.com";
        const EMAIL_LOGIN = "webmaster@hunjie.ca";
        const EMAIL_PASSWORD = "900724";
        const EMAIL_COMPLAIN = "complain@myca168.com";
        const EMAIL_INFO = "info@hunjie.ca";
        const EMAIL_ADMIN = "admin@hunjie.ca";
        const EMAIL_SALES = "sales@hunjie.ca";
	
	// get a row data by the field NAME
	public static function getRow($name) {
		// fetch the user's row
		$roleModel = new self ( );
			$select = $roleModel->select ();
			$select->where ( 'name = ? ', $name );
			return $roleModel->fetchRow ( $select );
	}
	
//get site information, return an array
	public static function getValues() {
		$roleModel = new self ( );
		$select = $roleModel->select ();
		$arr=array();
		$rows= $roleModel->fetchAll ( $select );
		foreach ($rows as $row) {
		$arr[$row->name]=$row->detail;
		}
		return $arr;
	}

	
	//update data for the site (all rows)
	public static function updateRows(array $newvalues) {
		// fetch the user's row
		$roleModel = new self ( );
		foreach ( $newvalues as $key=>$val ) {
			$select = $roleModel->select ();
			$select->where ( 'name = ? ', $key );
			$row = $roleModel->fetchRow ( $select );
			if ($row) {
				$row->detail = $val;
				$row->save ();
			}
		}
	}
	
	
	
}
