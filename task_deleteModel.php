<?php
include_once("Task.php");

class task_deleteModel{
	public $Task ;
	private $Dal ;
	
	function __construct($taskid)
	{
		include_once("Dal.php");
		$this->Dal = new Dal();
		$this->Task = $this->Dal->getTask($taskid);
	}
	
	function deleteTask()
	{
		include_once("Dal.php");
		$this->Dal = new Dal();
		return $this->Dal->deleteTask($this->Task->Id);
	}
}
?>