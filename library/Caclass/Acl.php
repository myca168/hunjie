<?php
/**
*/
class Caclass_Acl extends Zend_Acl
{
	const ROLE_GUEST = 'Guest';
	const ROLE_USER = 'User';
	const ROLE_AGENT = 'Agent';
	const ROLE_BILLING = 'Billing';
	const ROLE_MANAGER = 'Manager';
	const ROLE_ADMIN = 'Admin';

	protected static $_instance = null;
	//protected $_acl = null;

	/**
	 * Singleton pattern implementation makes "new" unavailable
	 *
	 */
	private function __construct()  {
		
		$this->addRole(new Zend_Acl_Role(self::ROLE_GUEST));
		
		// members have at least same access as guest
		$this->addRole(new Zend_Acl_Role(self::ROLE_USER), array(self::ROLE_GUEST));

		$this->addRole(new Zend_Acl_Role(self::ROLE_AGENT), array(self::ROLE_USER));
	
		$this->addRole(new Zend_Acl_Role(self::ROLE_BILLING), array(self::ROLE_AGENT));

		$this->addRole(new Zend_Acl_Role(self::ROLE_MANAGER), array(self::ROLE_BILLING));

		$this->addRole(new Zend_Acl_Role(self::ROLE_ADMIN), array(self::ROLE_MANAGER));
		
		// define our restricted controllers as resources.
		$this->add(new Zend_Acl_Resource('default/index'));
		$this->add(new Zend_Acl_Resource('default/login'));
		$this->add(new Zend_Acl_Resource('default/payment'));
		$this->add(new Zend_Acl_Resource('default/profile'));
		$this->add(new Zend_Acl_Resource('default/member'));
		$this->add(new Zend_Acl_Resource('default/agent'));
		$this->add(new Zend_Acl_Resource('admin/index'));
		$this->add(new Zend_Acl_Resource('admin/agent'));
		$this->add(new Zend_Acl_Resource('admin/pay'));
		$this->add(new Zend_Acl_Resource('admin/master'));
		
		$this->deny();
		
		$this->allow(self::ROLE_GUEST, 'default/index');
		$this->allow(self::ROLE_GUEST, 'default/login');
		$this->allow(self::ROLE_GUEST, 'default/member',array('index','new','thank','activate'));
		$this->allow(self::ROLE_GUEST, 'default/payment');
		$this->allow(self::ROLE_GUEST, 'default/profile',array('new','welcome','activate','recovery'));
		
		$this->allow(self::ROLE_USER, 'default/profile');
		$this->allow(self::ROLE_USER, 'default/member');
		$this->allow(self::ROLE_AGENT, 'default/agent');

		$this->allow(self::ROLE_BILLING, 'admin/index');
		
		$this->allow(self::ROLE_MANAGER);

		$this->allow(self::ROLE_ADMIN);
	}
	/**
	 * Returns this instance
	 *
	 */
	public static function getInstance()
	{
		if (null === self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
}