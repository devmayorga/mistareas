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
            </h4>
            <p class="card-text">
			
				<?php
				
				$i = 1 ;
				if(!empty($Model2->Documents))
				{
					foreach($Model2->Documents as $document)
					{
						if($document->Type == $documentoAcademico)
						{
							echo "<br /><a href='content/documents/tasks/". $Model2->Task->Id ."/". $document->Url ."'>" . $i . $document->Url . "</a>"; 
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
				
				if($Model2->User->Type == $masterType 
				&& $Model2->User->Id == $Model2->TaskOwner
				)
				{
					
					
					?>
					<br>
					<a href="subirarchivos.php?uid=<?php echo $_GET["uid"] ;?>&type=<?php echo $type ; ?>&task=<?php echo $Model2->Task->Id ;?>">Subir Recursos Académicos</a>
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
            </h4>
            <p class="card-text">
			
			<?php
				
				$i = 1 ;
				if(!empty($Model2->Documents))
				{
					foreach($Model2->Documents as $document)
					{
						if($document->Type == $ejercicioEnClase)
						{
							echo "<br /><a href='content/documents/tasks/". $Model2->Task->Id ."/". $document->Url ."'>" . $i . $document->Url. "</a>"; 
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
				
				if($Model2->User->Type == $masterType 
					&& $Model2->User->Id == $Model2->TaskOwner
					
					)
					{
					
						
							?>
							<br>
							<a href="subirarchivos.php?uid=<?php echo $_GET["uid"] ;?>&type=<?php echo $type?>&task=<?php echo $Model2->Task->Id ;?>">Subir Ejercicios</a>
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
            </h4>
            <p class="card-text">
				
				
				<?php
				
				$i = 1 ;
				if(!empty($Model2->Documents))
				{
					foreach($Model2->Documents as $document)
					{
						if($document->Type == $iniciativasPostClase)
						{
							echo "<br /><a href='content/documents/tasks/". $Model2->Task->Id ."/". $document->Url ."'>" . $i . $document->Url. "</a>"; 
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
				
				if($Model2->User->Type == $alumnoType
										
				
				)
				{				
				
					?>
					<br>
					<a href="subirarchivos.php?uid=<?php echo $_GET["uid"] ;?>&type=<?php echo $type?>&task=<?php echo $Model2->Task->Id ;?>">Subir Tareas</a>
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