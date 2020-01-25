<?php
include_once("task_displayModel.php");
include_once("HtmlHelper.php");
if(!empty($_GET["t"]) && !empty($_GET["uid"]) ){
	$Model2 = new task_displayModel($_GET["t"], $_GET["uid"]);
	
	
	
	$documentoAcademico = 1 ; 
	$ejercicioEnClase = 2 ; 
	$iniciativasPostClase = 3 ; 
	$masterType = 1 ; 
	$alumnoType = 2 ; 
	$types = [$documentoAcademico,$ejercicioEnClase,$iniciativasPostClase] ;
	
	
	?>
	
	
	
	
	<div class="row">
      <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100">
          <!--<a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>-->
          <div class="card-body">
            <h4 class="card-title">
              Recursos Académicos 
			  <?php
			  $type=$documentoAcademico ;
			  if($Model2->User->Type == $masterType 
					&& $Model2->User->Id == $Model2->TaskOwner)
			  {
				  ?>
				  <a href="subirarchivos.php?uid=<?php echo $_GET["uid"] ;?>&type=<?php echo $type ; ?>&task=<?php echo $Model2->Task->Id ;?>"><img src="img/document-add.png" /></a>
				  
				  <?php
			  }
			  
			  ?>
            </h4>
            <p class="card-text">
			
				<?php
				
				$i = 1 ;
				if(!empty($Model2->Documents))
				{
					$j=0;
					foreach($Model2->Documents as $document)
					{
						if($document->Type == $documentoAcademico)
						{
							$j++;
							$deleteString = "" ; 
							if($Model2->User->Id == $Model2->TaskOwner)
							{
								$deleteString = "<a href='document_delete.php"
							."?p=". $document->Id 
							."&document_name=". $document->Url 
							."&project_id=". $Model2->Task->ProjectId  
							. "'>[X]</a>" ;
							}
							
							echo "<br /><a href='content/documents/tasks/". $Model2->Task->Id ."/". $document->Url 
							."'>" 
							. "Recurso Académico " . $j 
							//. $document->Url 
							. "</a>"
							. $deleteString; 
						}
						$i ++ ;						
					}
				
				}
				else
				{
					?>
					<br />
					NO HAY DOCUMENTOS AÚN
					
				
				
					<?php
				}
				
				if($Model2->User->Type == $masterType 
				&& $Model2->User->Id == $Model2->TaskOwner
				)
				{
					
					
					?>
					<br>
					
					<?php
				}
				
				
				
				
				?>
			
			
			</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100">
          <!--<a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>-->
          <div class="card-body">
            <h4 class="card-title">
              Ejercicios
			  <?php
			  
			  if($Model2->User->Type == $masterType 
					&& $Model2->User->Id == $Model2->TaskOwner
					
					)
					{
					
						
							?>
							<br>
							<a href="subirarchivos.php?uid=<?php echo $_GET["uid"] ;?>&type=<?php echo $type?>&task=<?php echo $Model2->Task->Id ;?>"><img src="img/document-add.png" /></a>
							<?php
						
						
					}
			  
			  ?>
				<?php
			  $type=$ejercicioEnClase ;
			  ?>
			</h4>
            <p class="card-text">
			
			<?php
				
				$i = 1 ;
				if(!empty($Model2->Documents))
				{
					$j=0;
					foreach($Model2->Documents as $document)
					{
						if($document->Type == $ejercicioEnClase)
						{
							$j++;
							$deleteString = "" ;
							if($Model2->User->Id == $document->UploadedBy)
							{
								$deleteString = "<a href='document_delete.php"
							."?p=". $document->Id 
							."&document_name=". $document->Url 
							."&project_id=". $Model2->Task->ProjectId  
							. "'>[X]</a>" ;
							}
							
							echo "<br /><a href='content/documents/tasks/". $Model2->Task->Id ."/". $document->Url 
							."'>" 
							. "Ejercicio " . $j 
							//. $document->Url 
							. "</a>"
							. $deleteString;
						}
						$i ++ ;						
					}
				
				}
				else
				{
					?>
					<br />
					NO HAY DOCUMENTOS AÚN
					
				
				
					<?php
				}
				
				
				
				
				?>
			
			</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100">
          <!--<a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>-->
          <div class="card-body">
            <h4 class="card-title">
              Tareas
			  <?php
			  $type=$iniciativasPostClase ;
			  ?>
            </h4>
            <p class="card-text">
				
				
				<?php
				
				$i = 1 ;
				if(!empty($Model2->Documents))
				{
					$j=0;
					foreach($Model2->Documents as $document)
					{
						if($document->Type == $iniciativasPostClase)
						{
							
							$deleteString = "" ;
							if($Model2->User->Id == $document->UploadedBy || $Model2->User->Type==1)
							{
								$j++;
								$deleteString = "<a href='document_delete.php"
								."?p=". $document->Id 
								."&document_name=". $document->Url 
								."&project_id=". $Model2->Task->ProjectId  
								. "'>[X]</a>" ;
							
							$RecursoString = "<br /><a href='content/documents/tasks/". $Model2->Task->Id ."/". $document->Url 
								."'>" 
								. "Tarea " . $j . "</a>" ;
							
							
							echo $RecursoString							
								. $deleteString;
							
							}
							
							
						}
						$i ++ ;						
					}
				
				}
				else
				{
					?>
					<br />
					NO HAY DOCUMENTOS AÚN
					
				
				
					<?php
				}
				
				if($Model2->User->Type == $alumnoType
										
				
				)
				{				
				
					?>
					<br>
					<a href="subirarchivos.php?uid=<?php echo $_GET["uid"] ;?>&type=<?php echo $type?>&task=<?php echo $Model2->Task->Id ;?>"><img src="img/document-add.png" /></a>
					<?php					
					
				}
				
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
						?>
						Sending Error message....
						<?php
					}
					?>