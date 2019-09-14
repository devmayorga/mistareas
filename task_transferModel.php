<?php
include_once("Dal.php");
// include_once("Task.php");
// include_once("Project.php");

class task_transferModel{
	public $Task ;
	public $Projects ;
	private $Dal ;
	
	function __construct($taskid)
	{
		$this->Dal = new Dal();
		$this->Task = $this->Dal->getTask($taskid);
		$user = $this->Dal->getUserIdByTask($taskid) ;
		try
		{
		$this->Projects = $this->Dal->getUserProjects($user);
		}
		catch(Exception $e)
		{
			echo "taskTrasnerMofel";
		}
	}
}
?>

