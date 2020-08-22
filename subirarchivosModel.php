<?php
include_once("User.php");
include_once("Dal.php");

class subirarchivosModel{
	public $User ;
	private $Dal ;
	public $DocumentNatures ;
	
	function __construct($p_userid)
	{
		$this->Dal = new Dal();
		try
		{
		$this->User = $this->Dal->getUser($p_userid);
		$this->Dal->Close();
		$this->Dal = new Dal();
		$this->User->Licencia = $this->Dal->getUserLicencia($this->User->Id);
		$this->DocumentNatures = $this->Dal->getDocumentNatures();
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