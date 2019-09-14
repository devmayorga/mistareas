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
include ('db/dal.php');
include_once('HtmlHelper.php');
include_once("Partials.php");
if(isset($_POST["enviar"]))
{
	$model["patient"]["id"] = $_POST["userid"] ;
	$model["documentType"] = $_POST["documentType"];
	$model["surgery"]["id"] = $_POST["taskid"];
	
	
	switch($model["documentType"])
	{
		case '1':
		case '2':
		case '3':
		
			
			$type = $model["documentType"];
			foreach($_FILES as $file)
			{
				if (strlen($file["name"]) < 1)
				{
					continue;
				}
				$filename = $model["surgery"]["id"] . "_". $model["documentType"] ."_".$file["name"] ;
				$directory = "content/documents/tasks/" . $model["surgery"]["id"] . "/";
				
				$output = $directory  ;
				$validDirectory = false ;
				if(!is_dir($directory))
				{
					$output .= " no existe.";
					$output .= "<br />Intentando crear directorio:" . $directory ;  
					if(mkdir ( $directory, 0777, true ))
					{
						$output .= "<br />Directorio creado:" . $directory ;  
						
					}
					else
					{
						$output .= "<br />Directorio NO creado:" . $directory ;  
					}
					
				
				}
				else
				{
					$output .= " ya existe. ";
				}
				echo $output ; $output = "" ;
				$target_path = $directory . $filename ;
				$output .= "<br />Guardando " . $filename . " in " . $target_path;
				// echo $output ; $output = "" ;
				// - - - ! 20190518 - Ensure created folder has correct permissions
				chmod($directory, 0755);
				if(move_uploaded_file($file['tmp_name'], $target_path)) 
				{
					$output .= "<br />El archivo " . $filename ." se ha subido exitosamente al Sistema de Archivos! <br />";
					echo $output ; $output = "" ;
					include_once("Dal.php");
					$Dal = new Dal();
					$sql2 = "insert into document (url, type, taskid) values ('". $filename ."', ". $type .", ". $model["surgery"]["id"] .")";
					$res2 = mysqli_query($Dal->con, $sql2) or die ("Error al registrar el documento en el Sistema: " . $filename . "... Mensaje del sistema: " . mysqli_error($Dal->$con));
					$output .= "<br />El archivo " . $filename ." se ha registrado correctamente en el Sistema! <br />";
					// echo $output ; $output = "" ;
					?>
					
					<?php
				} else
				{
					$output .= "<br />Error al subir el archivo: " . $filename . "... Mensaje del sistema: Error en I/O ";					
					// echo $output ; $output = "" ;
				}
				
				echo $output ;
			}
			?>
			<?php
			HtmlHelper::RenderBackButton("Volver");
			?>
			<?php
		
		break;
		case "p":
		
			$filename = $_FILES['filetoupload']["name"] ;
			$target_path = "content/images/patients/" .$filename;
			

			if(move_uploaded_file($_FILES['filetoupload']['tmp_name'], $target_path)) 
			{
				$sql = "update patient set image = '". $filename . "' where Id = " . $model["patient"]["id"];
				$res = mysqli_query ($con, $sql) or die ("Error al guardar la imagen de un paciente... Mysql dice: " . mysqli_error($con));
				?>
				El archivo se ha subido exitosamente! <br />
				<a href="system.php">Volver al sistema</a>
				<?php
			} else
			{
				echo "ERROR AL SUBIR DOCUMENTO(S), POR FAVOR INTENTE DE NUEVO!";
			}
		break;
		
	}
	//header("Location: system.php");
}
else
{
	// - - - ! Instanciar el modelo
	$model["patient"]["id"] = $_GET["uid"];
	$model["surgery"]["id"] = null;
	if(isset($_GET["taskid"]))
	{
		$model["surgery"]["id"] = $_GET["taskid"];
	}
	
	switch($_GET["type"])
	{
		case '1':
			$message = "Subir documentos académicos";
		break;
		case "2":
			$message = "Subir Ejercicios en Clase";
		break;
		case "3":
			$message = "Subir tarea";
		break;
		case "p":
			$message = "Subir foto de perfil";
		break;
	}
	
	$message .= " de la tarea ". $_GET["task"] ." a nombre del usuario " . $_GET["uid"] . "</strong>";

	?>
	
	
	
	<?php
	Partial("partial-header", "", "");
	?>
	<center>
		<h4>
		<?php echo $message ;?>
			
		<?php
		//HtmlHelper.php
		HtmlHelper::renderBackButton("Volver");
		?>
		</h4>
		<form action="subirarchivos.php" method="post" style="margin-top: 20px;" enctype="multipart/form-data" >
		<input type="hidden" name="userid" value="<?php echo $_GET["uid"] ; ?>" />
		<input type="hidden" name="documentType" value="<?php echo $_GET["type"] ; ?>" />
		<input type="hidden" name="taskid" value="<?php echo $_GET["task"]; ?>" />
		
		
		
		
		<?php
		switch($_GET["type"])
		{
			case "p":
			?>
			<label for="file">Seleccione un archivo:</label>
			<input type="file" name="filetoupload" id="file"><br />
			
			<?php			
			break;
			case "1":
			case "2":
			case "3":
			for($i = 1 ; $i < 6; $i++)
			{
				?>
				<label for="file">Seleccione un archivo:</label>
				<input type="file" name="filetoupload<?php echo $i ; ?>" id="file<?php echo $i ; ?>"><br />
				<?php
			}
			break;
			default:
			echo "Something went really wrong... You should try to go back";
		}
		?>
		
		
		<input type="submit" name="enviar" value="enviar" />
		</form>
	</center>

	
	
	<?php
	
	

	
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