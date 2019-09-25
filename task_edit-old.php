<?php
session_start();
include_once("task_editModel.php");
if(!empty($_GET["t"])){
	$Model = new task_editModel($_GET["t"]);
	?>
	
	
	
	
	
	
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>mistareas.com.mx</title>
  </head>
  <body>
  
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
		
		
		
			Renombrar el Task "<?php echo $Model->Task->Name ; ?>". ¿Desea continuar?
			<form action="task_edit.php" method="post">
				<input type="hidden" value="<?php echo $Model->Task->Id ; ?>" name="taskid" />
				<input type="text" name="newName" value="<?php echo $Model->Task->Name ; ?>" />
				<input type="submit" value="Continuar" name="edit-task" />
				<a href="todolist.php?p=<?php echo $Model->Task->ProjectId ; ?>"><input type="button" value="Cancelar" name="cancelar" /></a>
			</form>
	
		
		
		
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
	<?php
}
else
{	
	if(isset($_POST["edit-task"]))
	{
		if(isset($_POST["taskid"]) )
		{
			if(isset($_POST["newName"]))
			{
				$Model = new task_editModel($_POST["taskid"]);
				$taskRenamed = $Model->renameTask($_POST["newName"]);
				if($taskRenamed)
				{
					$redirectLocation = "Location:todolist.php?p=" . $Model->Task->ProjectId; 
					header($redirectLocation);
				}
				else
				{
					?>
					TASK <?php echo $Model->Task->Name ; ?> NO RENOMBRADO !
					<?php
				}
			}
			
			if(isset($_POST["assiged-userid"]))
			{				
				$Model = new task_editModel($_POST["taskid"]);
				
				$assigneduserid = $Model->assignTask($_POST["assiged-userid"]);
				if($assigneduserid)
				{
					$redirectLocation = "Location:todolist.php?p=" . $Model->Task->ProjectId; 
					header($redirectLocation);
				}
				else
				{
					?>
					TASK <?php echo $Model->Task->Name ; ?> NO ASIGNADO !
					<?php
				}
			}
			
		}
		
		
	}
	else
	{
		if(isset($_POST["transferir"])
			&& isset($_POST["taskid"]) 
			&& isset($_POST["projectid"]) 
			)
		{
			
			include_once("task_transferModel.php");
			include_once("Dal.php");
			$model = new task_transferModel($_POST["taskid"]);
			$oldProject = $model->Task->ProjectId ; 
			$model->Task->ProjectId = $_POST["projectid"] ;
			$dal = new Dal();
			$tareaTransferida = $dal->transferTask($model->Task->Id, $model->Task->ProjectId);
			if($tareaTransferida)
			{
				// header("location: todolist.php?p=" . $oldProject);
				// return true ;
				?>
				<div>
				<p>"TAREA TRANSFERIDA!</p>
				
				<a href="todolist.php?p=<?php echo $model->Task->ProjectId ; ?>">IR AL PROYECTO RECEPTOR</a>
				</div>
				<?php
			}
			else
			{
				// echo "Tarea NO transferida";
				// return false ;
				echo "¡ERROR!";
			}
			
		}
	}
}
?>