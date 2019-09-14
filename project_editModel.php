<?php
include_once("Project.php");

class project_editModel{
	public $Project ;
	private $Dal ;
	
	function __construct($projectid)
	{
		include_once("Dal.php");
		$this->Project = new Project($projectid);
	}
	
	function renameProject($newName)
	{
		include_once("Dal.php");
		$this->Dal = new Dal();
		$this->Project->Name = $newName ;
		return $this->Dal->renameProject($this->Project);
	}
}
?>