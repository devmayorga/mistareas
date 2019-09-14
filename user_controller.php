<?php
session_start();
include_once("user_model.php");
include_once("Partials.php");
if(isset($_GET["id"]))
{
	$Model = new userModel($_SESSION["User"]["id"]);
}
else
{
	die('<a href="/">Inicio</a>');
}
?>
<html>
<head>

</head>
<body>
<a href="user_edit.php?id=<?php echo $Model->Id ; ?>">Editar Perfil</a>
<br />
<a href="todolist.php">Inicio</a>
<br />
<a href="todolist.php">Volver</a>
<?php
Partial("partial-footer", $Model->User, "css-footer" );
?>
</body>
</html>