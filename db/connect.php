<?php

$u = "root" ;
$p = "" ;
$h = "localhost" ;
$db = "todolist" ;

$con = mysqli_connect($h, $u, $p)or die ("Error de autenticacion... MySQL Dice: " . mysqli_error($con));
$res = mysqli_select_db($con, $db ) or die ("Error al seleccionar la BD... MySQL Dice: " . mysqli_error($con));

?>