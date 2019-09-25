
	
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
					include_once("project_editModel.php");
					if(!empty($_GET["p"])){
						$Model = new project_editModel($_GET["p"]);
						?>
		
					PARA RENOMBRAR EL PROYECTO <?php echo $Model->Project->Name ; ?> ESCRIBA UN NUEVO NOMBRE Y PRESIOE "Continuar"
					<form action="project_edit.php" method="post">
					<input type="hidden" value="<?php echo $Model->Project->Id ; ?>" name="projectid" />
					<input type="text" value="<?php echo $Model->Project->Name ; ?>" name="newName" />
					<input type="submit" value="Continuar" name="edit-project" />
					<a href="todolist.php?p=<?php echo $Model->Project->Id ; ?>"><input type="button" value="Cancelar" name="cancelar" /></a>
					</form>
					<br/>
					<center>
					<p> O BIEN </p>
					</center>
					SI DESEA BORRAR EL PROYECTO PULSE EL SIGUIENTE ICONO: <a href="project_delete.php?p=<?php echo $Model->Project->Id ;?>"><img   class="img-delete"  src="img/delete-color.png"></a>
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
									NUEVO NOMBRE DEL PROYECTO: <?php echo $Model->Project->Name ; ?>
									<br>
									<a href="todolist.php?p=<?php echo $Model->Project->Id ; ?>">VER EL PROYECTO</a>
									<?php
								}
								else
								{
									?>
									PROYECTO <?php echo $Model->Project->Name ; ?> NO RENOMBRADO !
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
	
	
	
	
	
	
	
	
	
	