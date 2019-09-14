<?php
include_once("Task.php");

class task_undoModel{
	public $Task ;
	private $Dal ;
	
	function __construct($taskid)
	{
		include_once("Dal.php");
		$this->Dal = new Dal();
		$this->Task = $this->Dal->getTask($taskid);
	}
	
	function undoTask()
	{
		include_once("Dal.php");
		$this->Dal = new Dal();
		return $this->Dal->undoTask($this->Task->Id);
	}
}
?>