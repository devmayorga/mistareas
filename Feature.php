<?php
include_once("Project.php");
class Feature
{
    public $Id ;
    public $Name ;
	
    
    function __construct($p_id = 0, $p_name="")
    {
		
        $this->Id = $p_id ;
		$this->Name = $p_name ;
		
    }
	
}

?>