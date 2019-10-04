<?php
include_once("User.php");
include_once("Dal.php");

class usuarios_noasignadosModel implements JsonSerializable{
	public $Users ;
	public $Task ;
	private $Dal ;
	private $TaskUserOwner ;
	function __construct($p_taskid)
	{
		
		try
		{
			$this->Dal = new Dal();
			$this->Task = $this->Dal->getTask($p_taskid);
			$this->Dal->Close();
			$this->Dal = new Dal();
			$this->TaskUserOwner = new User($this->Dal->getUserIdByTask($p_taskid));
			$this->Dal->Close();
			$this->Dal = new Dal();
			$this->TaskUserOwner->Friends = $this->Dal->getUserFriends($this->TaskUserOwner->Id);
			$this->Dal->Close();
			// $this->Users = $this->Dal->getUnassignedUsers($p_taskid);
			foreach($this->TaskUserOwner->Friends as $candidate)
			{
				$this->Dal = new Dal();
				$userHasTask = $this->Dal->userHasAssignedTask($candidate->Id, $p_taskid);
				$this->Dal->Close();
				if( ! $userHasTask)
				{
					$this->Users[] = $candidate ;
				}
				
			}
			
			// $this->Dal->Close();
			// foreach($this->Users as $user)
			// {
				// $this->Dal = new Dal();
				// $user->Friends = $this->Dal->getUserFriends($user->Id);
				// $this->Dal->Close();
			// }
		}
		catch (Exception $e)
		{
			echo "usuarios_noasignadosModel Catched the Exception";
		}
		
		//$this->Dal->Close();
	}
	
	
	public function jsonSerialize() {
        return $this->Users;
    }
}
?>