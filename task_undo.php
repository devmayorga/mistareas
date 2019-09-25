<?php
include_once("Partials.php");
include_once("task_undoModel.php");
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

if(!empty($_GET["t"]))
{
	$Model = new task_undoModel($_GET["t"]);
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
						Marcando el Task <small>"<?php echo $Model->Task->Name ; ?>"</small> como NO COMPLETADO.
						<h2>
						<br >
						¿Desea continuar?
						<form action="task_undo.php" method="post">
							<input type="hidden" value="<?php echo $Model->Task->Id ; ?>" name="taskid" />
							<input  class="btn btn-warning" type="submit" value="Continuar" name="undo-task" />
							<a  class="btn btn-secondary"  href="todolist.php?p=<?php echo $Model->Task->ProjectId ; ?>">Cancelar</a>
						</form>
						</p>
					
				<?php
					}
					else
					{	
						if(isset($_POST["undo-task"]))
							{
								if(isset($_POST["taskid"]))
								{
									$Model = new task_undoModel($_POST["taskid"]);
									$taskDeleted = $Model->undoTask();
									if($taskDeleted)
									{
										?>
										<p>
										<br>
										TASK "<?php echo $Model->Task->Name ; ?>" AHORA MARCADO COMO NO COMPLETADO !
																			
										</p>
										<?php
									}
									else
									{
										?>
										TASK <?php echo $Model->Task->Name ; ?> NO CAMBIADO !
										<?php
									}
									?>
									<a class="btn btn-secondary" href="todolist.php?p=<?php echo $Model->Task->ProjectId ; ?>">VOLVER</a>
									<br />
									<br />
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
