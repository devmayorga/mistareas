<?php
include_once("Task.php");
include_once("Dal.php");

class task_editModel{
	public $Task ;
	private $Dal ;
	
	function __construct($taskid)
	{		
		$this->Dal = new Dal();
		$this->Task = $this->Dal->getTask($taskid);
	}
	
	function renameTask($newName)
	{		
		$this->Dal = new Dal();
		$this->Task->Name = $newName ;
		return $this->Dal->renameTask($this->Task);
	}
	
	function assignTask($userid)
	{
		$this->Dal = new Dal(); 
		return $this->Dal->assignTask($this->Task->Id, $userid);
	}
	
	function unassignTask($userid)
	{
		$this->Dal = new Dal(); 
		$retval =  $this->Dal->unassignTask($this->Task->Id, $userid);
		$this->Dal->Close();
		return $retval ; 
	}
}
?>