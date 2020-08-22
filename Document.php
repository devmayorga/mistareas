<?php

class Document
{

	public $Id ; 
	public $Rowdate ; 
	public $Type ; 
	public $TaskId ; 
	public $r_task_user_id ; 
	public $Url ; 
	public $UploadedBy ; 
	public $Comment ;	 
	public $Nature ; 
	
	function __construct($p_id
		, $p_rowdate = ""
		, $p_type = ""
		, $p_taskid = ""
		, $p_taskuserid = ""
		, $p_url = ""
		, $p_uploadedby = ""
		, $p_comment="" 
		)
		{
			$this->Id = $p_id;
			$this->Rowdate = $p_rowdate;
			$this->Type = $p_type ;
			$this->TaskId = $p_taskid;
			$this->r_task_user_Id = $p_taskuserid;
			$this->Url = $p_url;
			$this->UploadedBy = $p_uploadedby;
			$this->Comment = $p_comment	;
			
		}
	
}



?>