<?php
include_once("User.php");
include_once("Dal.php");

class subirarchivosModel{
	public $User ;
	private $Dal ;
	
	function __construct($p_userid)
	{
		$this->Dal = new Dal();
		try
		{
		$this->User = $this->Dal->getUser($p_userid);
		}
		catch (Exception $e)
		{
			echo "subirarchivosModel Catched the Exception";
		}
		
		$this->Dal->Close();
	}
	
	public function retrieveTask($taskId)
	{
		$this->Dal = new Dal();
		return $this->Dal->getTask($taskId);
		$this->Dal->Close();
	}
}
?>