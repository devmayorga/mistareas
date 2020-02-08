<?php
include_once("Project.php");
include_once("Feature.php");
class User
{
    public $Id ;
    public $Name ;
	public $Projects ;
	private $Dal ;
	public $Email ="" ;
	public $Type = 0 ;
    public $Features ;
	public $Friends ;
	public $NotFriends ;
	public $SolicitudesEnviadas ;
	public $SolicitudesRecibidas ;
	public $ArtistName = ""; 
	public $Licencia ;
	public $TempPass = "";
	
	
    function __construct($p_id = 0, $p_name="")
    {
		include_once("Dal.php");
		// $this->Dal = new Dal();
        $this->Id = $p_id ;
		$this->Name = $p_name ;
		$this->ArtistName = $p_name ;
		$this->TempPass = "simple";
		try
		{
			// $this->Projects = $this->Dal->getUserProjects($this->Id);		
			//$this->Features = $this->Dal->getUserFeatures($p_id);		
		}
		catch(Exception $e){
			echo "Exception catched in User class";
		}
    }
	
	function HasTeamCreate()
	{
		$retVal = false ;
		if($this->Features !== null)
		{
			foreach($this->Features as $feature)
			{
				if($feature->Name == "CreateTeam")
				{
					$retVal = true ;
				}
			}
		}
		
		return $retVal ;
	}
	
	function getConnectionStatus($user2)
	{
		$this->Dal = new Dal();
		$regreso =  $this->Dal->getConnectionStatus($this->Id , $user2);
		$this->Dal->Close();
		return $regreso ;
	}
	
	function HasUserCreate()
	{
		return $this->Type == 1 ;
	}
	
	function hasAssignedTask($p_taskid)
	{
		$this->Dal = new Dal();
		$regreso =  $this->Dal->userHasAssignedTask($this->Id , $p_taskid);
		$this->Dal->Close();
		return $regreso ;
	}
	
}

?>