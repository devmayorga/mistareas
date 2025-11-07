<?php
include_once("User.php");
include_once("Dal.php");

class todolistModel{
	public $User ;
	private $Dal ;
	
	function __construct($p_userid)
	{
		$this->Dal = new Dal();
		try
		{
		$this->User = $this->Dal->getUser($p_userid);
		// $this->Dal->Close();
		$this->Dal = new Dal();
		$this->User->Features = $this->Dal->getUserFeatures($this->User->Id);
		$this->Dal->Close();
		$this->Dal = new Dal();
		$this->User->Friends = $this->Dal->getUserFriends($this->User->Id);
		$this->Dal->Close();
		$this->Dal = new Dal();
		$this->User->NotFriends = $this->Dal->getUserNotFriends($this->User->Id);
		$this->Dal->Close();
		$this->Dal = new Dal();
		$this->User->SolicitudesEnviadas = $this->Dal->getUserSolicitudes($this->User->Id, "Enviadas");
		$this->Dal->Close();
		$this->Dal = new Dal();
		$this->User->SolicitudesRecibidas = $this->Dal->getUserSolicitudes($this->User->Id, "Recibidas");
		$this->Dal->Close();
		$this->Dal = new Dal();
		$this->User->Licencia = $this->Dal->getUserLicencia($this->User->Id);
		// echo "Model Created";
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			echo "todolistModel Catched the Exception";
		}
		// finally
		// {
			//$this->Dal->Close();
		// }
		
	}
}
?>