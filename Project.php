<?php
include_once("Task.php");
class Project
{
    public $Id ;
    public $Name ;
	public $Tasks ;
    private $Dal;
    function __construct($p_id = 0, $p_name="", $op_userId = 0 )
    {
		include_once("Dal.php");
		$this->Dal = new Dal();
        $this->Id = $p_id ;
		
		if($op_userId == 0)
		{
			$tasks = $this->Dal->getProjectTasks($this->Id);
			$name = $this->Dal->getProjectName($p_id);
		}
		else
		{
			$tasks = $this->Dal->getAssignedTasks($op_userId);
			$name = "Tareas Asignadas";
		}
		$this->Tasks = $tasks ;
		$this->Name = $name ; 
		
	$this->Dal->Close();	
    }
	
}

?>