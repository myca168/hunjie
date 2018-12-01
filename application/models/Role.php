<?php
class Model_Role extends Zend_Db_Table_Abstract {
	/**
	 * The default table name
	 */
	protected $_name = 'roles';
	//protected $_primary = 'id';
	//protected $_dependentTables = array('Model_User');
	
	const GUEST = 'Guest';
	const USER = 'User';
	const AUTHOR = 'Author';
	const EDITOR = 'Editor';
	const SALE = 'Sales';
	const BILLING = 'Billing';
	const SUPERADMIN='SuperAdmin';
	const MANAGER = 'Manager';
	const ADMIN = 'Admin';
	const IT = 'IT';
	
 	
	public function createRole($role) {
		// create a new row
		$rowRole = $this->createRow ();
		if ($rowRole) {
			// update the row values
			$rowRole->role = $role;
			$rowRole->save ();
			//return the new user
			return $rowRole;
		} else {
			throw new Zend_Exception ( "Could not create role ! " );
		}
	}
	
	public static function getRoles() {
		$roleModel = new self ( );
		$select = $roleModel->select ();
		$select->order('level');
		return $roleModel->fetchAll ( $select );
	}
	
	public static function getRole($id)
	{
		$roleModel = new self ( );
		$select = $roleModel->select ();
		$select->where('id = ?', $id);
		
    // fetch the user's row
    $rowRole = $roleModel->fetchRow( $select );
    
    	if($rowRole) {
        return $rowRole->role;
    	}else{
        throw new Zend_Exception("Could not found the role !");
    	}
	}
	
	public static function getRoleByName($name)
	{
		$roleModel = new self ( );
		$select = $roleModel->select ();
		$select->where('role = ?', $name);
    	$rowRole = $roleModel->fetchRow( $select );
    
    	if($rowRole) {
        return $rowRole;
    	}else{
        throw new Zend_Exception("Could not found the role !");
    	}
	}
	
	public function updateRole($id, $role) {
		// fetch the user's row
		$rowRole = $this->find ( $id )->current ();
		
		if ($rowRole) {
			// update the row values
			$rowRole->role = $role;
			$rowRole->save ();
			//return the updated user
			return $rowRole;
		} else {
			throw new Zend_Exception ( "Update failed.  Role not found!" );
		}
	}
	
	public function deleteRole($id) {
		// fetch the user's row
		$rowRole = $this->find ( $id )->current ();
		if ($rowRole) {
			$rowRole->delete ();
		} else {
			throw new Zend_Exception ( "Could not delete the role.  the role not found!" );
		}
	}

}
