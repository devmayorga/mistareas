<link rel="stylesheet" type="text/css" href="Partials.css">
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<title>mistareas.com.mx</title>



<div class="container">
	<?php
	  $headerFile = "utils/header-david.php";
	  // needed in the included file
	  $callingFromLevelUp = true ; 
	  include_once($headerFile);
	?>
  <div class="row">
	<div class="col" style="background-color: #7dcbe1 ; "></div>
	<div class="col">
		<div class="row">
			<div class="col" style="background-color: #7dcbe1 ; "></div>
			<div class="col" style="background-color: #f5ddea ; " ></div>
		  </div>
	</div>
	<div class="col" style="background-color: #f5ddea ; " ></div>
  </div>
  <div class="row">
	<div class="col" style="background-color: #7dcbe1 ; "></div>
	<div class="col" style="min-width:800px; " >
	
					<?php
						session_start();
						include_once("project_deleteModel.php");
						if(!empty($_GET["p"])){
							$Model = new project_deleteModel($_GET["p"]);
							?>



								Esta a punto de Borrar el Proyecto <?php echo $Model->Project->Name ; ?>. ¿Desea continuar?
								<form action="project_delete.php" method="post">
									<input type="hidden" value="<?php echo $Model->Project->Id ; ?>" name="projectid" />
									<input type="submit" value="Continuar" name="delete-project" />
									<a href="todolist.php?p=<?php echo $Model->Project->Id ; ?>"><input type="button" value="Cancelar" name="cancelar" /></a>
								</form>

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
											<a href="home.php">INICIO</a>
											<?php
										}
										else
										{
											?>
											PROYECTO <?php echo $Model->Project->Name ; ?> NO BORRADO !
											<?php
										}
									}
								}
							}
							?>
	
	
	</div>
	<div class="col" style="background-color: #f5ddea ; " ></div>
  </div>
  <div class="row">
	<div class="col" style="background-color: #7dcbe1 ; "></div>
		<div class="row">
			<div class="col" style="background-color: #7dcbe1 ; "></div>
			
			<div class="col" style="background-color: #f5ddea ; " ></div>
		</div>
	<div class="col" style="background-color: #f5ddea ; " ></div>
  </div>
  
  <?php
  include_once("utils/footer-david.php");
  ?>
  
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

