<?php

class DocumentNature
{
	public $Id ;
    public $Name ;
    

    function __construct($p_id = 0 , $p_name = "Undefined")
    {
        $this->Id = $p_id ;
        $this->Name = $p_name;
    }
}
?>