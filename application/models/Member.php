<?php
class Model_Member extends Zend_Db_Table_Abstract {
	/**
	 * The default table name
	 */
	protected $_name = 'member';
	const FLAG = TRUE;        //to determine the site is free or not to agents
	const TYPE_MEMBER = 'Member';
	const TYPE_VIP = 'VIP';
	const TYPE_SUPERVIP = 'Super VIP';
	const STATUS_ACTIVE = 'Active';
	const STATUS_INACTIVE = 'Inactive';
    const STATUS_PENDING="Pending";  // Unable to use recovery function to reset password
    
	
	public function createUser($email, $pwd,$agent=0,$name,$lname,$birth,$sex,$tel,$city,$live,
	$height,$weight,$ethics,$rel,$drink,$smoke,$marriage,$child,$job,$pay,$nation,
			$edu,$english,$chinese,$hobby,$animal,$star,$title,$me,$love) 
	{
  	// create a new row
		$rowUser = $this->createRow ();
		if ($rowUser) {
			// update the row values
			$rowUser->email = $email;
			$rowUser->password = md5 ( $pwd );
			$rowUser->role_id = Model_Role::USER;
			$rowUser->agent_id =$agent;
			$rowUser->name=$name;
			$rowUser->lname=$lname;
			$rowUser->birth=$birth;
			$rowUser->sex=$sex;
			$rowUser->tel=$tel;
			$rowUser->city=$city;
			$rowUser->country=$live;
			$rowUser->height=$height;
			if ($weight!='') {
				$rowUser->weight=$weight;
			}
			$rowUser->ethics=$ethics;
			$rowUser->religion=$rel;
			$rowUser->drink=$drink;
			$rowUser->smoke=$smoke;
			$rowUser->marriage=$marriage;
			$rowUser->child=$child;
			$rowUser->job=$job;
			if ($pay=='') {$pay=0;}
			$rowUser->pay=$pay;
			$rowUser->nationality=$nation;
			$rowUser->edu=$edu;
			$rowUser->english=$english;
			$rowUser->chinese=$chinese;
			$rowUser->hobby=$hobby;
			$rowUser->animal=$animal;
			$rowUser->star=$star;
			$rowUser->title=$title;
			$rowUser->me=$me;
			$rowUser->love=$love;
			$rowUser->created_date=date("Y-m-d", time());
			
			
		//	$rowUser->status =self::STATUS_INACTIVE;
		   if ($agent!=0) {
                        $rowUser->status =self::STATUS_ACTIVE;
		   }             
			$rowUser->save ();
			//return the new user
			return $rowUser;
		} else {
			throw new Zend_Exception ( "Could not create user! " );
		}
	}
	
	public function editUser($id,
			$name,$lname,$birth,$sex,$tel,$city,$live,
			$height,$weight,$ethics,$rel,$drink,$smoke,$marriage,$child,$job,$pay,
			$nation,$edu,$english,$chinese,$hobby,$animal,$star,$title,$me,$love
	)
	{
		// fetch the user's row
		$rowUser = $this->find ( $id )->current ();
	
		if ($rowUser) {
			// update the row values
			$rowUser->name=$name;
			$rowUser->lname=$lname;
			$rowUser->birth=$birth;
			$rowUser->sex=$sex;
			$rowUser->tel=$tel;
			$rowUser->city=$city;
			$rowUser->country=$live;
			$rowUser->height=$height;
			if ($weight!='') {
			$rowUser->weight=$weight;
			} else {
			$rowUser->weight=0;
			}
			$rowUser->ethics=$ethics;
			$rowUser->religion=$rel;
			$rowUser->drink=$drink;
			$rowUser->smoke=$smoke;
			$rowUser->marriage=$marriage;
			$rowUser->child=$child;
			$rowUser->job=$job;
			if ($pay=='') {$pay=0;}
			$rowUser->pay=$pay;
			$rowUser->nationality=$nation;
			$rowUser->edu=$edu;
			$rowUser->english=$english;
			$rowUser->chinese=$chinese;
			$rowUser->hobby=$hobby;
			$rowUser->animal=$animal;
			$rowUser->star=$star;
			$rowUser->title=$title;
			$rowUser->me=$me;
			$rowUser->love=$love;
			$rowUser->save ();
			//return the new user
			return $rowUser;
		} else {
			throw new Zend_Exception ( "User update failed.  User not found! " );
		}
	}
	//** below methods for Admin Section **//
	
	public static function getAll() {
		$userModel = new self ( );
		$select = $userModel->select ();
		return $userModel->fetchAll ( $select );
	}
	
	public static function getMembersOnly() {
		$userModel = new self ( );
		$select = $userModel->select ();
		$select->where ('role_id = ?',Caclass_Acl::ROLE_USER);
		$select->order ('created_date desc');
		return $userModel->fetchAll ( $select );
	}
	
	public static function getAgentsOnly() {
		$userModel = new self ( );
		$select = $userModel->select ();
		$select->where ('role_id = ?',Caclass_Acl::ROLE_AGENT);
		return $userModel->fetchAll ( $select );
	}
	
	
	//** End of methods for Admin **//
	
	
	public function newVisit($email) {	
	 	$select = $this->select();
        $select->where("email = ?", $email);
        $row = $this->fetchRow($select);
 		if ($row) {
			$row->last_visit = date( 'Y-m-d H:i:s', time());
			$row->save ();
		} else {
			throw new Zend_Exception ( "Update failed.  User not found!" );
		}
	}
	
	public function getUsersByRoleId($id) {
		$select = $this->select();
	//	$userModel = new self ( );
	//	$select = $userModel->select ();
		$select->where('role_id = ? ',$id);
		return $this->fetchAll ( $select );
	}
	
	//default search for members
	public static function searchUsers($gender,$age1,$age2,$country,$pic) {
		$db=Zend_Db_Table::getDefaultAdapter();
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		$select=$db->select();
		
		$role=Caclass_Acl::ROLE_USER;
		$status=self::STATUS_ACTIVE;
		$today=date("Y-m-d", time());
		$date1=date('Y-m-d', strtotime("-$age1 years"));
		$date2=date('Y-m-d', strtotime("-$age2 years"));
		
		/*
		$userModel = new self ( );
		$date1=date('Y-m-d', strtotime("-$age1 years"));
		$date2=date('Y-m-d', strtotime("-$age2 years"));
		$select = $userModel->select ();
		$select->where('status = ? ',self::STATUS_ACTIVE);
		$select->where('country = ? ',$country);
		$select->where ('img = ?',$pic);
		$select->where ('role_id = ?',Caclass_Acl::ROLE_USER);
		$select->where ('birth >= ?',$date2);
		$select->where ('birth <= ?',$date1);
		$select->order ('created_date desc');
	    */
		//	var_dump($select->__toString());
		//	exit;
		$sql="SELECT `m`.* FROM `member` AS `m`
		WHERE (m.role_id ='$role' )
		AND (m.status ='$status' ) AND (m.country ='$country' ) 
		AND (m.img ='$pic' ) 
		AND (m.sex ='$gender' ) 
		AND (m.birth >='$date2' )
		AND (m.birth <='$date1' )
		ORDER BY `m`.`created_date` desc";
		$stmt = $db->query($sql);
		return $stmt->fetchAll();
	
		// return $userModel->fetchAll ( $select );
	}
	/*
	public static function searchUsers($gender,$age1,$age2,$country,$pic) {
		$userModel = new self ( );
		$date1=date('Y-m-d', strtotime("-$age1 years"));
		$date2=date('Y-m-d', strtotime("-$age2 years"));
		$select = $userModel->select ();
		$select->where('status = ? ',self::STATUS_ACTIVE);
		$select->where('country = ? ',$country);
		$select->where ('img = ?',$pic);
		$select->where ('role_id = ?',Caclass_Acl::ROLE_USER);
		$select->where ('birth >= ?',$date2);
		$select->where ('birth <= ?',$date1);
		$select->order ('created_date desc');
		
	//	var_dump($select->__toString());
	//	exit;
				
		return $userModel->fetchAll ( $select );
	}
	*/
	//advanced search for members
	public static function advSearch(
	$gender,$age1,$age2,$country,$nation,$edu,$ethic,$marr,$child,$drink,$smoke,$animal,$star,$pic)
	{
		$db=Zend_Db_Table::getDefaultAdapter();
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		$select=$db->select();
		
		$role=Caclass_Acl::ROLE_USER;
		$status=self::STATUS_ACTIVE;
		$today=date("Y-m-d", time());
		$date1=date('Y-m-d', strtotime("-$age1 years"));
		$date2=date('Y-m-d', strtotime("-$age2 years"));
		

		$sql="SELECT `m`.* FROM `member` AS `m`
		WHERE (m.role_id ='$role' )
		AND (m.status ='$status' ) 
		AND (m.img ='$pic' )
		AND (m.sex ='$gender' )
		AND (m.birth >='$date2' )
		AND (m.birth <='$date1' )";
		if ($country!=-1) { 
			$sql.="AND (m.country='$country' )";
		}
		if ($nation!=-1) {
			$sql.="AND (m.nationality='$nation' )";
		}
		
		if ($edu!=-1) {
			$sql.="AND (m.edu='$edu' )";
		}
		
		if ($ethic!=-1) {
			$sql.="AND (m.ethics='$ethic' )";
		}
		
		if ($marr!=-1) {
			$sql.="AND (m.marriage='$marr' )";
		}
		
		if ($child!=-1) {
			$sql.="AND (m.child='$child' )";
		}
		
		if ($drink!=-1) {
			$sql.="AND (m.drink='$drink' )";
		}
		
		if ($smoke!=-1) {
			$sql.="AND (m.smoke='$smoke' )";
		}
		
		if ($animal!=-1) {
			$sql.="AND (m.animal='$animal' )";
		}
		
		if ($star!=-1) {
			$sql.="AND (m.star='$star' )";
		}
		
		$sql.="ORDER BY
		`m`.`created_date` desc";
		$stmt = $db->query($sql);
		return $stmt->fetchAll();
	}
	
	/*
	public static function advSearch(
	$gender,$age1,$age2,$country,$nation,$edu,$ethic,$marr,$child,$drink,$smoke,$animal,$star,$pic) 
	{
		$userModel = new self ( );
		$date1=date('Y-m-d', strtotime("-$age1 years"));
		$date2=date('Y-m-d', strtotime("-$age2 years"));
		$select = $userModel->select ();
		$select->where('status = ? ',self::STATUS_ACTIVE);
		if ($country!=-1) {
		$select->where('country = ? ',$country);
		}
		if ($nation!=-1) {
			$select->where('nationality = ? ',$nation);
		}
		
		if ($edu!=-1) {
			$select->where('edu = ? ',$edu);
		}
		
		if ($ethic!=-1) {
			$select->where('ethics = ? ',$ethic);
		}
		
		if ($marr!=-1) {
			$select->where('marriage = ? ',$marr);
		}
		if ($child!=-1) {
			$select->where('child = ? ',$child);
		}
		if ($drink!=-1) {
			$select->where('drink = ? ',$drink);
		}
		
		if ($smoke!=-1) {
			$select->where('smoke = ? ',$smoke);
		}
		
		if ($animal!=-1) {
			$select->where('animal = ? ',$animal);
		}
		
		if ($star!=-1) {
			$select->where('star = ? ',$star);
		}
		$select->where ('img = ?',$pic);
		$select->where ('role_id = ?',Caclass_Acl::ROLE_USER);
		$select->where ('birth >= ?',$date2);
		$select->where ('birth <= ?',$date1);
		$select->order ('created_date desc');
		return $userModel->fetchAll ( $select );
	}
	*/
	public static function getUsers() {
		$userModel = new self ( );
		$select = $userModel->select ();
		$select->order ('created_date');
		return $userModel->fetchAll ( $select );
	}
	
	//Return recent active members
	/*
	public function getRecent($ltd=25) {
		$dd=date("Y-m-d", time());
		$select = $this->select();
		$select->where('role_id = ? ',Caclass_Acl::ROLE_USER);
		$select->where('status = ? ',self::STATUS_ACTIVE);
		$select->where("id IN 
		(select uid from invoice where start_date<$dd and end_date>$dd and paid_flag=1)");
		$select->order ('created_date desc');
		$select->order ('id desc');
		$select->limit($ltd);
		var_dump($select->__toString());
		exit;
		return $this->fetchAll ( $select );
	}
	*/
	
	public function getRecent($ltd=25) {
		$select = $this->select();
		$role=Caclass_Acl::ROLE_USER;
		$status=self::STATUS_ACTIVE;
		
		$select->where('role_id = ?',$role);
		$select->where('status = ?',$status);
		$select->order ('id desc');
		$select->limit($ltd);
		return $this->fetchAll($select);
		
	//	var_dump($select->__toString());
	//	exit;
	  
		/*
		$sql="SELECT DISTINCT `m`.* FROM `member` AS `m` 
				LEFT JOIN `invoice` AS `i` ON m.id=i.uid WHERE (m.role_id ='$role' ) 
				AND (m.status ='$status' )  AND (i.start_date <= '$today') AND 
				(i.end_date >= '$today') AND (i.paid_flag = 1)  ORDER BY 
				`m`.`created_date` desc, `m`.`id` desc LIMIT 18";

		$stmt = $db->query($sql);
		return $stmt->fetchAll();
		*/
		
		
	}
	
	//Return members with images order by SQN1
	public function getMembersWithPhoto($ltd=18) {
		$select = $this->select();
		$select->where('img = ? ',1);
		$select->where('sqn1 != ? ',99);
		$select->where('role_id = ? ',Caclass_Acl::ROLE_USER);
		$select->where('status = ? ',self::STATUS_ACTIVE);
		$select->order ('sqn1');
		if ($ltd!=0) {
		$select->limit($ltd);
		}
		return $this->fetchAll ( $select );
	}
	
	//Set order for members with images by SQN1
	public function setOrder($id,$sqn) {
		$row = $this->find ( $id )->current ();
	
		if ($row) {
			// update the row values
			$row->sqn1 = $sqn;
			$row->save ();
			//return the row
			return $row;
		} else {
			throw new Zend_Exception ( "Update failed ! " );
		}
	}
	
	public static function getUsersByAgent($agent=0) {
		$userModel = new self ( );
		$select = $userModel->select ();
		$select->where ('agent_id = ?', $agent );
		$select->order ('sqn1');
		$select->order ('sqn2');
		return $userModel->fetchAll ( $select );
	}
	
	public static function getUserByEmail($email) {
		$userModel = new self ( );
		$select = $userModel->select ();
		$select->where ('email = ?', $email );
		$user=$userModel->fetchRow ( $select );
		if ($user) {return $user;} else {return false;}
	}
	
	public static function getUserById($id) {
		$userModel = new self ( );
		$select = $userModel->select ();
		$select->where ('id = ?', $id );
		$user=$userModel->fetchRow ( $select );
		if ($user) {return $user;} else {return false;}
	}
	//Get member by ID or Email 
	public static function getByEmailId($IdOrEmail) {
		$userModel = new self ( );
		$select = $userModel->select ();
		$select->where ('id = ?', $IdOrEmail);
		$select->orWhere ('email = ?', $IdOrEmail);
		$user=$userModel->fetchRow ( $select );
		if ($user) {return $user;} else {return false;}
	}
	
	public function getObjById($id) {
		return $this->find ( $id )->current ();
	}
	
	public static function getUser($email,$password) {
		$userModel = new self ( );
		$select = $userModel->select ();
		$select->where ('email = ?', $email );
		$select->where ('password = ?', $password );
		return $userModel->fetchRow ( $select );
	}
	
	
	//Change user status
	public function changeStatus($id,$status) 
	{
		$rowUser = $this->find ( $id )->current ();
		
		if ($rowUser) {
			// update the row values
			$rowUser->status = $status;
			$rowUser->save ();
			//return the new user
			return $rowUser;
		} else {
			throw new Zend_Exception ( "Status update failed.  User not found! " );
		}
	}
	
	//Change user role
	public function changeRole($id,$role) 
	{
		$rowUser = $this->find ( $id )->current ();
		
		if ($rowUser) {
			// update the row values
			$rowUser->role_id = $role;
			$rowUser->save ();
			//return the new user
			return $rowUser;
		} else {
			throw new Zend_Exception ( "Role update failed ! " );
		}
	}
	
	public function updatePassword($id, $password) {
		// fetch the user's row
		$rowUser = $this->find ( $id )->current ();
		
		if ($rowUser) {
			//update the password
			$rowUser->password = md5 ( $password );
			$rowUser->save ();
		} else {
			throw new Zend_Exception ( "Password update failed.  User not found!" );
		}
	}
	
	public static function delUser($id) {
		
		$userModel = new self ( );
		$select = $userModel->select ();
		$select->where ('id = ?', $id );
		$user=$userModel->fetchRow ( $select );
		
		if ($user) {
			$user->delete ();
		} else {
			throw new Zend_Exception ( "Could not delete user.  User not found!" );
		}
	}
	
	public function resetPassword($email) {
          	
		$select = $this->select();
		$select->where ('email = ?', $email );
		$user=$this->fetchRow ( $select );
		$newPass=$this->createRandomPassword();
		$user->password = md5 ( $newPass );

                if ($user->status==self::STATUS_INACTIVE) {
		$user->status=self::STATUS_ACTIVE;
		}

		$user->save ();
		$login=$user->name;
	 			$email_from=Model_Site::getRow(Model_Site::SITE_WEBMASTER)->detail;
         		$subject="Hi $login ,您的密码已重设！";
         		$msg= "Hi {$login} , 您的新密码是： $newPass". "\n"."\n\n"."谢谢!";
              	
              	Caclass_Mail::smtp($email_from,$email,$subject,$msg);

	        return $user;

        return $user;
	}
	
	protected function createRandomPassword() {

	$chars = "abcdefghijkmnopqrstuvwxyz023456789";

    srand((double)microtime()*1000000);

    $i = 0;

    $pass = '' ;

    	while ($i <= 7) {

        $num = rand() % 33;

        $tmp = substr($chars, $num, 1);

        $pass = $pass . $tmp;

        $i++;

    }

    return $pass;

	}
}