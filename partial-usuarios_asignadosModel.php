<?php
include_once("User.php");
include_once("Dal.php");

class usuarios_asignadosModel{
	public $Users ;
	public $Task ;
	private $Dal ;
	
	function __construct($p_taskid)
	{
		$this->Dal = new Dal();
		try
		{
			$this->Task = $this->Dal->getTask($p_taskid);
			$this->Users = $this->Dal->getAssignedUsers($p_taskid);
		}
		catch (Exception $e)
		{
			echo "usuarios_asignadosModel Catched the Exception";
		}
		
		$this->Dal->Close();
	}
}
?>