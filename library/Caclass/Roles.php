<?php
/**
*/
class Caclass_Roles
{
	/**
	 *
	 */
	public static function getRoles()
	{
		$arr=array();
		$roles=Model_Role::getRoles();
		foreach ($roles as $role) {
			if ($role->role!='SuperAdmin'){
			$arr[$role->role]=$role->role;
			}
		}
		return $arr;
		
	}
	//for sales team
	public static function getSomeRoles()
	{
		$arr=array();
		$roles=Model_Role::getRoles();
		foreach ($roles as $role) {
			if (in_array($role->role,array(Model_Role::EDITOR,Model_Role::AUTHOR,Model_Role::USER,Model_Role::SALE)))
			{$arr[$role->role]=$role->role;}
		}
		return $arr;
		
	}
	
}