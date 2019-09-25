<?php
include_once("User.php");
include_once("Dal.php");

class usuarios_noasignadosModel implements JsonSerializable{
	public $Users ;
	public $Task ;
	private $Dal ;
	
	function __construct($p_taskid)
	{
		$this->Dal = new Dal();
		try
		{
			$this->Task = $this->Dal->getTask($p_taskid);
			$this->Users = $this->Dal->getUnassignedUsers($p_taskid);
		}
		catch (Exception $e)
		{
			echo "usuarios_noasignadosModel Catched the Exception";
		}
		
		$this->Dal->Close();
	}
	
	
	public function jsonSerialize() {
        return $this->Users;
    }
}
?>