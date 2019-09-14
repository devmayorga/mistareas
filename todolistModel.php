<?php
include_once("User.php");
include_once("Dal.php");

class todolistModel{
	public $User ;
	private $Dal ;
	
	function __construct($p_userid)
	{
		$this->Dal = new Dal();
		try
		{
		$this->User = $this->Dal->GetUser($p_userid);
		}
		catch (Exception $e)
		{
			echo "todolistModel Catched the Exception";
		}
		
		$this->Dal->Close();
	}
}
?>