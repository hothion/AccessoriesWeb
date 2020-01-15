<?php
class User{
	public $password;
	public $role;
	public $fullName;
	function getShortName(){
		$spacePos = strpos($this->fullName, ' ');
		if($spacePos){
			return substr($this->fullName, 0, $spacePos);
		}
		return $this->fullName;
	}
	function canManagePhuKien(){
		return $this->role == "admin";
	}
	function canBuyPhuKien(){
		return $this->role == "user";
	}
	
}
?>