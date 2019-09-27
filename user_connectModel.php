<?php
//include_once("User.php");
include_once("Dal.php");

class userConnectModel{
	public $User1 ;
	public $User2 ;
	private $Dal ;
	
	function __construct($p_userid1, $p_userid2)
	{
		
		try
		{
			
			$this->Dal = new Dal();
			$this->User1 = $this->Dal->GetUser($p_userid1);
			$this->Dal->Close();
			
			$this->Dal = new Dal();
			$this->User2 = $this->Dal->GetUser($p_userid2);
			$this->Dal->Close();
		}
		catch (Exception $e)
		{
			echo "userConnectModel Catched the Exception";
		}
		finally
		{
			$this->Dal->Close();
		}
		
	}
	
	function Action($action)
	{
		$this->Dal = new Dal();
		$regreso =  $this->Dal->editarConexion($this->User1->Id , $this->User2->Id, $action);
		$this->Dal->Close();
		
		return $regreso ; 
	}
	
	
	
}
?>