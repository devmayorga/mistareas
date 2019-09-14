<?php
class Task
{
    public $Id ;
    public $Name ;
	public $Completed ;
	public $ProjectId ; 
    
    function __construct($p_id = 0, $p_name="", $p_completed=false, $p_projectid=0)
    {
        $this->Id = $p_id ;
		$this->Name = $p_name ;
		$this->Completed = $p_completed ;
		$this->ProjectId = $p_projectid ;
    }
}

?>