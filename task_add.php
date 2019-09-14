<?php
session_start();

include_once("db/connect.php");
include_once("Partials.php");
include_once("Dal.php");
include_once("Task.php");
$description = $_POST["description"] ;
$done = $_POST["done"] ;
$id = 1 ;

$sql = "insert into task (description, completed, projectid) values ('". $_POST["description"] ."', '". $_POST["done"] ."', '". $_POST["projectid"] ."')" ; 
//echo $sql . "..."; 
$res = mysqli_query($con,$sql) or die ("Error al insertar task" . mysqli_error($con));

$sql = "select max(taskid) taskid from task";
//echo $sql . "..."; 
$res = mysqli_query($con, $sql) or die ("Error al obtener Task Id");
$row = mysqli_fetch_assoc($res);
$id = $row["taskid"];



$dal = new Dal() ;
$insertedTask = $dal->getTask($id);
Partial("partial-task-display", $insertedTask, "");
?>
