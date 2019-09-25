<?php
include_once("Partials.php");
include_once("project_deleteModel.php");
include_once("todolistModel.php");
session_start();

if(!isset($_SESSION["User"]))
{	
	$userid = 0 ; 
}
else
{
	$userid = $_SESSION["User"]["id"];
}



$Model2 = new todolistModel($userid);



$renderFirstTime = false ;

if(!empty($_GET["p"]))
{
	$Model = new project_deleteModel($_GET["p"]);
	$renderFirstTime = true ;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>

  <?php
	Partial("partial-metas", null, "");
  ?>

</head>

<body>
	<?php
	Partial("partial-navigator", $Model2->User, "");
	?>
 
  <!-- Page Content -->
  <div class="container">
	<br />
	<br />
    

    

    

		<?php
					
					if($renderFirstTime){
						
						?>
						<p>
						<h2>
						Borrando Proyecto: <small>" <?php echo $Model->Project->Name ; ?> "</small>.
						<h2>
						<br >
						¿Desea continuar?
						<form action="project_delete.php" method="post">
							<input type="hidden" value="<?php echo $Model->Project->Id ; ?>" name="projectid" />
							<input class="btn btn-danger" type="submit" value="Continuar" name="delete-project" />
							<a class="btn btn-secondary" href="project_edit.php?p=<?php echo $Model->Project->Id ; ?>">Cancelar</a>
						</form>
						</p>
					
				<?php
					}
					else
					{	
						if(isset($_POST["delete-project"]))
								{
									if(isset($_POST["projectid"]))
									{
										$Model = new project_deleteModel($_POST["projectid"]);
										$projectDeleted = $Model->deleteProject();
										if($projectDeleted)
										{
											?>
											PROYECTO <?php echo $Model->Project->Name ; ?> BORRADO !
											<br>
											
											<?php
										}
										else
										{
											?>
											PROYECTO <?php echo $Model->Project->Name ; ?> NO BORRADO !
											<?php
										}
										?>
										<a class="btn btn-primary" href="home.php">INICIO</a>
										<?php
									}
								}
					}
					?>
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
