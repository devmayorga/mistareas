<?php
include_once("User.php");
include_once("Dal.php");

class user_upgradeModel{
	public $User ;
	private $Dal ;
	
	function __construct($userid)
	{		
		$this->Dal = new Dal();
		$this->User = $this->Dal->getUser($userid);
	}
	
	function upgradeUser($upgradeCode)
	{		
		$this->Dal = new Dal();
		return $this->Dal->upgradeUser($this->User->Id , $upgradeCode);
	}
	
	
}
?>