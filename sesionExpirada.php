<?php
include_once("userController.php");
$userController = new userController();
$userController->verificarSesion();
include_once("Partials.php");
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
  Partial("partial-navigator", "EXPIRED" , "" ) ;
  ?>

  <!-- Page Content -->
  <div class="container">
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
	
			SESION EXPIRADA O CERRADA EN OTRA INSTANCIA DE LA PLATAFORMA. <a href="utils/auth/logout.php">Inicio</a>
			
		
    
  </div>
  <!-- /.container -->

  <?php
  Partial("partial-footer", null, "");
  ?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  
  
</html>
