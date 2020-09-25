<?php
include_once("Task.php");

class task_displayModel{
	public $Task ;
	private $Dal ;
	public $User ; 
	public $Documents ;
	public $TaskOwner ;
	public $DocumentNatures ;
	function __construct($taskid, $userid)
	{
		include_once("Dal.php");
		$this->Dal = new Dal();
		$this->Task = $this->Dal->getTask($taskid);
		try
		{
		$this->User = $this->Dal->getUser($userid);
		}
		catch(Exception $e)
		{
			echo "Error en Los Apoyos Digitales";
		}
		
		$this->Documents = $this->retrieveDocuments();
		$this->Dal->Close();
		$this->Dal = new Dal();		
		$this->DocumentNatures = $this->Dal->getDocumentNatures();
	}
	
	function retrieveTaskOwner()
	{
		return $this->Dal->getUserIdByTask($this->Task->Id) ; 
	}
	
	function retrieveDocuments()
	{
		$this->TaskOwner = $this->retrieveTaskOwner();
		return $this->Dal->getTaskDocuments($this->Task->Id);
	}
	
}
?>