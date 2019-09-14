<?php
session_start();

include_once("db/connect.php");

$id = $_POST["id"] ;
$done = $_POST["done"] ;


$sql = "update task set completed = " . $done  . " where taskid = " . $id ;
echo $sql . "..."; 
$res = mysqli_query($con, $sql) or die ("Error al actualizar task" . mysqli_error($con));

?>