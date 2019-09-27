<?php
session_start();
//
include_once("todolistModel.php");
include_once("Partials.php");
$Model = new todolistModel($_SESSION["User"]["id"]);
/*A estas alturas del partido. Si el Usuario no tiene Id es porque caducó la sesion.*/
if(strlen($Model->User->Name) < 1)
{
  ?>
  <script language="javascript">
  window.location.href="sesionExpirada.php";
  </script>
  <?php
}
$statusRequest = "vacio" ;
if(
	
	 isset($_GET["userid1"])
	&& isset ($_GET["userid2"])
	)
{
	$statusRequest = "AHORA PROCESO LA DESCONEXION" ;
}






?>

<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>mistareas.com.mx</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">


	


</head>

<body>

  <!-- Navigation -->
  <?php
  Partial("partial-navigator", $Model->User , "" ) ;
  ?>

  <!-- Page Content -->
  <div class="container">
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <p>
  <?php
	
		echo $statusRequest;
	
	
  ?>
  </p>
  
  <p>
  <a href="user_connections.php" class="btn btn-secondary">Volver</a>
  </p>
	
  
  
	
	
	
  </div>
  <!-- /.container -->

  <?php
  Partial("partial-footer", null, "");
  ?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  
  

</body>

</html>
