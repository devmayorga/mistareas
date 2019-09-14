<?php
include_once("User.php");

class userModel{
	public $User ;
	private $Dal ;
	
	function __construct($id)
	{
		include_once("Dal.php");
		$this->Dal = new Dal();
		try
		{
		$this->User = $this->Dal->getUser($id);
		}
		catch(Exception $e)
		{
			echo "ASD";
		}
	}
	
}
?>