<?php
session_start();
if(!isset($_SESSION["User"]))
{	
	$userid = 0 ; 
	?>
	<script language="javascript">
	window.location.href="sesionExpirada.php";
	</script>
	<?php
}
include_once("Partials.php");
include_once("subirarchivosModel.php");
include_once('db/dal.php');
include_once('HtmlHelper.php');


$documentTypes = ["","Documentos académicos", "Ejercicios", "Tareas"];
$output="";

if(isset($_POST["enviar"]))
{
	$model["patient"]["id"] = $_POST["userid"] ;
	$model["documentType"] = $_POST["documentType"];
	$model["surgery"]["id"] = $_POST["taskid"];
	$model["nature"] = $_POST["nature"];
	$_GET["uid"] = $_POST["userid"];
	$_GET["task"] = $_POST["taskid"] ;
	$_GET["type"] = $_POST["documentType"] ;
	
	switch($model["documentType"])
	{
		case '1':
		case '2':
		case '3':
		
			
			$type = $model["documentType"];
			$output .= "<hr>";
			$output .= "*****PROCESANDO  DOCUMENTOS*****";
			$i = 0 ; 
			foreach($_FILES as $file)
			{
				if (strlen($file["name"]) < 1)
				{
					continue;
				}
				$filename = $model["surgery"]["id"] . "_". $model["documentType"] ."_".$file["name"] ;
				$directory = "content/documents/tasks/" . $model["surgery"]["id"] . "/";
				
				// $output .= "<br />-SUBIENDO ARCHIVO ". ++$i ."-"   ;
				$i++;
				$validDirectory = false ;
				if(!is_dir($directory))
				{
					// $output .= "<br /> no existe.";
					// $output .= "<br />Intentando crear directorio:";
					// $output .= "<br />Verificando directorio para subir archivos.";
					if(mkdir ( $directory, 0777, true ))
					{
						// $output .= "<br />Directorio creado:" . "OK" ;  
						
					}
					else
					{
						// $output .= "<br />Directorio NO creado:" . " FALLO" ;  
					}
					
				
				}
				else
				{
					// $output .= "<br />Directorio OK!";
				}
				//echo $output ; $output = "" ;
				$target_path = $directory . $filename ;
				// $output .= "<br />Guardando " . $filename . " in " . $target_path;
				// $output .= "<br />Guardando archivo" ;
				// echo $output ; $output = "" ;
				// - - - ! 20190518 - Ensure created folder has correct permissions
				chmod($directory, 0755);
				if(move_uploaded_file($file['tmp_name'], $target_path)) 
				{
					// $output .= "<br />El archivo " . $filename ." se ha subido exitosamente al Sistema de Archivos!";
					//echo $output ; $output = "" ;
					include_once("Dal.php");
					$Dal = new Dal();
					$sql2 = "insert into document (url, type, taskid, uploadedBy, r_document_nature) values ('"
						. $filename 
						."', ". $type 
						.", ". $model["surgery"]["id"] 
						.", ". $model["patient"]["id"]
						.", ". $model["nature"]
						.")";
					$res2 = mysqli_query($Dal->con, $sql2) or die ("Error al registrar el documento en el Sistema: " . $filename . "... Mensaje del sistema: " . mysqli_error($Dal->$con));
					// $output .= "<br />El archivo " . $filename ." se ha registrado correctamente en el Sistema!";
					// echo $output ; $output = "" ;
					?>
					
					<?php
				} else
				{
					$output .= "<br />Error al subir el archivo: " . $filename . "... Mensaje del sistema: Error en I/O ";					
					// echo $output ; $output = "" ;
				}
				// $output .= "<br />-CARGA DE ARCHIVO ". $i ." TERMINADA-";
				//echo $output ;
			}
			$output .= "<br>*****DOCUMENTOS PROCESADOS: ". $i ."*****";
			$output .= "<hr>";
		
		break;
		
		
		
	}
	//header("Location: system.php");
	
}
$Model = new subirarchivosModel($_GET["uid"]);
$currentTask = $Model->retrieveTask($_GET["task"]);
if($Model->User->Type == 2)
{
	$currentProject = new Project("", "", $Model->User->Id);
	$currentProject->Id = $currentTask->ProjectId ;
}
else
{
	foreach($Model->User->Projects as $p)
	{
		if($p->Id == $currentTask->ProjectId)
		{
			$currentProject = $p ;
			break ;
		}
	}
}

$currentType = $documentTypes[$_GET["type"]];


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
	Partial("partial-navigator", $Model->User, "");
	?>
 
  <!-- Page Content -->
  <div class="container">
	<br />
    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">Subir <?php echo $currentType ; ?> a la tarea
      <small> <?php echo $currentTask->Name ; ?> </small>
    </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item"></li>
      <li class="breadcrumb-item "><a href="home.php">Clases</a></li>	  
      <li class="breadcrumb-item "><a href="todolist.php?p=<?php echo $Model->User->Type == 1 ?  $currentProject->Id  : -1 ; ?>"><?php echo $currentProject->Name ; ?></a></li>
      <li class="breadcrumb-item "><a href="todolist.php?p=<?php echo $Model->User->Type == 1 ?  $currentProject->Id  : -1 ; ?>&ariaExpanded=<?php echo $currentTask->Id ; ?>#ancla-task-<?php echo $currentTask->Id ; ?>"><?php echo $currentTask->Name  ; ?></a></li>
      <li class="breadcrumb-item active">Subir <?php echo $currentType ; ?></li>
    </ol>
	<?php
	if(strlen($output) > 0)
	{
		echo $output ;
		
	}
	?>	
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
			for($i = 1 ; $i < 2; $i++)
			{
				?>
				<label for="nature">Seleccione el tipo de recurso:</label>
				<select id="nature" name="nature">
					<?php
					foreach($Model->DocumentNatures as $nature)
					{
						?>
						<option value="<?php echo $nature->Id ; ?>"><?php echo $nature->Name  == "Undefined" ? "Sin definir" : $nature->Name ; ?></option>
						<?php
					}
					?>
				</select>
				<br />
				<label for="file">Seleccione un archivo:</label>
				<input type="file" name="filetoupload<?php echo $i ; ?>" id="file<?php echo $i ; ?>"><br />
				
				<?php
			}
			break;
			default:
			echo "Something went really wrong... You should try to go back";
		}
		?>
		
	
		<input class="btn btn-success" type="submit" name="enviar" value="enviar" />
		
		<?php
		$UserType = $Model->User->Type==1 ? $currentProject->Id : "-1";
		$linkToRender = 'todolist.php?p='
			. $UserType 
			. '&ariaExpanded='.$currentTask->Id.'#ancla-task-' . $currentTask->Id ;
		
		HtmlHelper::renderBackButton("Volver", $linkToRender);
		?>
	</form>
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
