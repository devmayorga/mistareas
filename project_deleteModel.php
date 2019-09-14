<?php
include_once("Project.php");

class project_deleteModel{
	public $Project ;
	private $Dal ;
	
	function __construct($projectid)
	{
		include_once("Dal.php");
		$this->Project = new Project($projectid);
	}
	
	function deleteProject()
	{
		include_once("Dal.php");
		$this->Dal = new Dal();
		return $this->Dal->deleteProject($this->Project->Id);
	}
}
?>