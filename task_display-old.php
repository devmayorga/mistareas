<?php
session_start();
include_once("task_displayModel.php");
include_once("HtmlHelper.php");
if(!empty($_GET["t"]) && !empty($_GET["uid"]) ){
	$Model = new task_displayModel($_GET["t"], $_GET["uid"]);
	?>
	
	
	
	
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
					<div  style="margin:5px; ">
					<?php
					HtmlHelper::renderBackButton("Volver");
					?>
					</div>
					<br />
					<h3>
					<?php
					echo $Model->Task->Name ; 
					?>
					</h3>
	
					
					<center>
					<table style="margin:20px;" border>
					<tr>
						<th>Recursos academicos</th>
						<th>Ejercicios en Clase</th>
						<th>Tareas y otras iniciativas</th>
					</tr>
					<tr>
						<?php
							$documentoAcademico = 1 ; 
							$ejercicioEnClase = 2 ; 
							$iniciativasPostClase = 3 ; 
							$masterType = 1 ; 
							$alumnoType = 2 ; 
							$types = [$documentoAcademico,$ejercicioEnClase,$iniciativasPostClase] ;
							foreach($types as $type)
							{
								?>
								<td>
								<?php
								
								switch($type){
									case $documentoAcademico :
										if($Model->User->Type == $masterType 
									&& $Model->User->Id == $Model->TaskOwner
									)
									{
										
										
										?>
										<a href="subirarchivos.php?uid=<?php echo $_GET["uid"] ;?>&type=<?php echo $type ; ?>&task=<?php echo $Model->Task->Id ;?>">Subir Documentos Académicos</a>
										<?php
									}
									break ;
									case $ejercicioEnClase :
										if($Model->User->Type == $alumnoType
										|| $Model->User->Type == $masterType
									
									)
									{
									
										if(true)
										{
											?>
											<a href="subirarchivos.php?uid=<?php echo $_GET["uid"] ;?>&type=<?php echo $type?>&task=<?php echo $Model->Task->Id ;?>">Subir Ejercicios en Clase</a>
											<?php
										}
										
									}
									break ;
									case $iniciativasPostClase :
										if($Model->User->Type == $alumnoType
									
									
									)
									{				
									
										?>
										<a href="subirarchivos.php?uid=<?php echo $_GET["uid"] ;?>&type=<?php echo $type?>&task=<?php echo $Model->Task->Id ;?>">Subir Tareas</a>
										<?php					
										
									}
									break ;
								
								}
								
								?>
								<hr />
								<?php
								
								
								
								
								
								$i = 1 ;
								if(!empty($Model->Documents))
								{
									foreach($Model->Documents as $document)
									{
										if($document->Type == $type)
										{
											echo "<br /><a href='content/documents/tasks/". $Model->Task->Id ."/". $document->Url ."'>" . $i . $document->Url; 
										}
										$i ++ ;						
									}
								
								}
								else
								{
									?>
									<p>
									NO HAY DOCUMENTOS AÚN
									</p>
								
								
									<?php
								}
									
								?>
								</td>
								<?php
							}
						
						
						?>
					</tr>
				</table>
				</center>
					<?php
				}
				else
				{	
					?>
					Sending Error message....
					<?php
				}
				?>
	
		
		
		
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
	
	
	
	