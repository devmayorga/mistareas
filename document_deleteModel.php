<?php
include_once("Document.php");

class document_deleteModel{
	public $Document ;
	public $ProjectId ; 
	private $Dal ;
	
	function __construct($documentid)
	{
		include_once("Dal.php");
		$this->Document = new Document($documentid);
	}
	
	function deleteDocument()
	{
		include_once("Dal.php");
		$this->Dal = new Dal();
		return $this->Dal->deleteDocument($this->Document->Id);
	}
}
?>