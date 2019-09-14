<?php
session_start();
include_once("Project.php");
include_once("Dal.php");
include_once("Partials.php");

//$Project["name"] = $_POST["name"] ;
$Dal = new Dal() ;
$Project = $Dal->insertProject($_POST["name"], $_SESSION["User"]);
Partial("partial-project-thumbnail", $Project, "");
?>

	
