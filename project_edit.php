<?php
include_once("Partials.php");
include_once("project_editModel.php");
include_once("todolistModel.php");
include_once("HtmlHelper.php");
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
	$Model = new project_editModel($_GET["p"]);
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
  <div class="container mt-5">
	<br />
	<br />
    

    

    

		<?php
					
					if($renderFirstTime){
						
						?>
					<!-- Page Heading/Breadcrumbs -->
					<h1 class="mt-4 mb-3">Editando el Proyecto:
					  
					  <small> <?php echo $Model->Project->Name ; ?> </small>
					  
					 
					</h1>
					 
					 <br >
					 <h3>ACCIONES DISPONIBLES: </h3>
					 <br >
					 <div class="row">
					 
					 
						<div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
							<div class="card h-100">
							  <!--
							  <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
							  -->
							  <div class="card-body">
								<h4 class="card-title">
								  RENOMBRAR
								</h4>
								<br >
								<form class="card-text" action="project_edit.php" method="post">
									<input type="hidden" value="<?php echo $Model->Project->Id ; ?>" name="projectid" />
									<input type="text" value="<?php echo $Model->Project->Name ; ?>" name="newName" />
									<br >
									<br >
									
									<input class="btn btn-success" type="submit" value="Continuar" name="edit-project" />							
								</form>
							  </div>
							</div>
						</div>
						
						<div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
							<div class="card h-100">
							  <!--
							  <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
							  -->
							  <div class="card-body">
								<!-- <h4 class="card-title">
								  BORRAR
								</h4> -->
								<p class="card-text" >
									<a href="project_delete.php?p=<?php echo $Model->Project->Id ;?>"><img   class="img-delete"  src="img/delete-color.png"></a>							
								</p>
							  </div>
							</div>								
						</div>
						
						
						<div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
							<div class="card h-100">
							  <!--
							  <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
							  -->
							  <div class="card-body">
								<!-- <h4 class="card-title">
								  VOLVER
								</h4> -->
								<p class="card-text" >
									
									<?php
									HtmlHelper::renderBackButton("Volver", 'todolist.php?p=' . $Model->Project->Id );
									?>
								</p>
							  </div>
							</div>								
						</div>
					 
					 </div>
					 
					
				<?php
					}
					else
					{	
						if(isset($_POST["edit-project"]))
						{
							if(isset($_POST["projectid"]) && isset($_POST["newName"]))
							{
								$Model = new project_editModel($_POST["projectid"]);
								$projectRenamed = $Model->renameProject($_POST["newName"]);
								if($projectRenamed)
								{
									?>
									
									<h1 class="mt-4 mb-3 text-center">NUEVO NOMBRE DE PROYECTO:
									  <small> <?php echo $Model->Project->Name ; ?> </small>
									</h1>
									<?php
								}
								else
								{
									?>
									<h1 class="mt-4 mb-3 text-center">PROYECTO NO RENOMBRADO:
									  <small> <?php echo $Model->Project->Name ; ?> </small>
									</h1>									
									<?php
								}
								?>
								<div class="text-center " >
									<a  href="todolist.php?p=<?php echo $Model->Project->Id ; ?>"  class="btn  btn-primary">VER EL PROYECTO</a>
									<a  href="home.php"  class="btn  btn-primary">VER TODOS LOS PROYECTOS</a>
								</div>
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
