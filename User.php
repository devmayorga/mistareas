<?php
include_once("Project.php");
class User
{
    public $Id ;
    public $Name ;
	public $Projects ;
	private $Dal ;
	public $Email ="" ;
	public $Type = 0 ;
    
    function __construct($p_id = 0, $p_name="")
    {
		include_once("Dal.php");
		$this->Dal = new Dal();
        $this->Id = $p_id ;
		$this->Name = $p_name ;
		try
		{
			$this->Projects = $this->Dal->getUserProjects($this->Id);		
		}
		catch(Exception $e){
			echo "Exception catched in User class";
		}
    }
	
}

?>