<?php
function Partial($partialToRender, $Model, $css_class)
{
	switch($partialToRender)
	{
		case "partial-project-thumbnail":
			?>
			<div class="col-lg-3 col-md-4 col-sm-6 portfolio-item" >
				<div class="card h-100">
				  <!--
				  <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
				  -->
				  <div class="card-body">
					<h4 class="card-title">
					  <a href="todolist.php?p=<?php echo $Model->Id ; ?>"> <?php echo $Model->Id < 0 ? "Tareas asignadas" : $Model->Name ; ?></a>
					</h4>
					<p class="card-text" style="display:none;">
					<?php echo $Model->Id ; ?>
					</p>
				  </div>
				</div>
			</div>
			
			
			
			<?php
		break ;
		case "inicio-d":
			echo "ASD";
		break;
		case "d-legend":
			?>
			<table class="d-legend-table">
				<tr>
					<td class="d-legend-left">ORGANIZACIÓN</td>
					<td class="d-legend-right">EDUCACIÓN</td>
				</tr>
				<tr>
					<td class="d-legend-left">CREATIVIDAD</td>
					<td class="d-legend-right">TECNOLOGÍA</td>
				</tr>
				
			</table>
			<?php
		break;
		case "home-d":
			session_start();
			//
			include_once("todolistModel.php");
			$Model = new todolistModel($_SESSION["User"]["id"]);
			/*A estas alturas del partido. Si el Usuario no tiene Id es porque caducó la sesion.*/
			if(strlen($Model->User->Name) < 1)
			{
			  ?>
			  <script language="javascript">
			  window.location.href="sesionExpirada.php";
			  </script>
			  <?php
			}
			if(isset($_GET["p"]))
			{
				foreach($Model->User->Projects as $p)
				{
					if($_GET["p"] == $p->Id)
					{
						$currentProject = $p ;
						break ;
					}
				}
			}
			else
			{

				if(isset($Model->User->Projects[0]))
				{
					$currentProject = $Model->User->Projects[0];
				}
				else
				{
					$currentProject = null ; 
				}
			}
			
			if(is_null($currentProject))
			{
				$projectId = 0 ;
			}
			else
			{
				$projectId = $currentProject->Id ;
			}
			Partial("partial-displayprojects-small-open", $Model->User,$projectId);
		break;
		case "login":
			?>
			
			<form  action="login3.php" method="post" name="form_login" >
				<table>	
					<tr>
						<td>&nbsp;</td>
						<td>
						<!-- <a href="../../user_create.php">Click aqui si aun no se encuentra inscrito en <span style="font-weight: bold;"><?php echo $_GET ["appid"] ;?></span></a> -->
						</td>
					</tr>
					<tr>
						<th>User</th>
						<td><input type="text" name="txt_user" id="txt_user" /></td>
					</tr>
					<tr>
						<th>Password</th>
						<td><input type="password" name="txt_pass" id="txt_pass" /></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" value="Login!" name="send" id="btn_send" /></td>
					</tr>
				</table>				
				
				<input type="hidden" name="appid" value="<?php echo $_GET["appid"]?>" />
				
			</form>
			<?php
		break;
		case "logo":
			$imagePath = $Model ; 
			if(isset($Model) )
			{
				
				$imagePath = $Model;
					
			}
			?>
			<img src="<?php echo $imagePath ; ?>" />
			<?php
		break;
		case "partial-metas":
			?>
			
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<meta name="description" content="">
			<meta name="author" content="">

			<title>mistareas.com.mx</title>

			<!-- Bootstrap core CSS -->
			<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

			<!-- Custom styles for this template -->
			<link href="css/modern-business.css" rel="stylesheet">
			
			<?php
		break ;
		case "partial-header":
			
		break;
		case "partial-displayprojects-small-open":
		$renderMenu1 = true ;
		case "partial-displayprojects-small" :
		if(!isset($renderMenu1) )
		{
			$renderMenu1 = false ;
		}
		//Partial("partial-header", $renderMenu1, "");
		?>				
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />		
		<div
		class="row projectslist"
		<?php
		if(!$renderMenu1)
		{
			?>
			style="display:none;"
			<?php
		}
		?>
		>
			<div class="col" id="projectslist"  style="/*border: 1px solid yellow; */padding-left:18px; padding-right:18px;/*width:100%;*/">
				<!-- <img id="project-menu-hide" class="img-menuproject"  src="img/menuproject-color.png" /> -->
				<h1>TAREAS AGRUPADAS POR PROYECTO </h1>
				<?php
				foreach($Model->Projects as $p)
				{
					Partial("partial-project-thumbnail", $p, "");
				}
				?>
			</div>		
		</div>
		<?php
		if($Model->Type != 2)
		{
			?>
			<div>
				<img src="img/addproject-color.png" class="img-addproject" id="add-project-button" />
				
				<div id="create-new-project-form" style="/*padding-top:15px;*/ margin-top: 15px; padding-left: 15px;  border: 1px solid black ; " class="create-new-project-form">
					<h3>
						Creando nuevo Proyecto
					</h3>
					<table>
						<tr>
							<th>Nombre</th></tr>
						<tr>
							<td><input type="text" id="projectname" name="projectname"></td>		
							<td><input type="button" value="Crear" name="addproject" id="addproject"></td>
						</tr>
					</table>
					<div style="text-align:center;"  ><img src="img/hide-color.png" id="hide-project-button" class="img-hide" /></div>
				</div>
			</div>
			<?php
		}
		?>
		
		<?php
		break;
		case "partial-navigator":
			?>
			
			
			<!-- Navigation -->
			  <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light fixed-top">
				<div class="container">
				  <a class="navbar-brand" href="home.php"><img src="img/logo.png"></a>
				  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				  </button>
				  <div class="collapse navbar-collapse" id="navbarResponsive" style="/*border:1px solid red;*/">
				  
					<?php
					if($Model!="EXPIRED")
					{
						?>
							<ul class="navbar-nav ml-left" >
							
							
							<li class="nav-item" >
								<?php
								if($Model->Type==1)
								{
									?>
									<a class="nav-link" href="home.php">Proyectos</a>
									<?php
								}
								else
								{
									?>
									<a class="nav-link" href="todolist.php">Tareas asignadas</a>
									<?php
								}
								?>
							  
							</li>

							<?php
								if($Model->Type==1)
								{
									?>
									<li class="nav-item" >
									<a class="nav-link" href="todolist.php?p=-1">Tareas asignadas</a>
									</li>

									<?php
								}
								
								?>

							<li class="nav-item" >
							  <a class="nav-link" href="user_connections.php">Conexiones</a>
							</li>
							
							
							<?php
								
								
								if( $Model->HasUserCreate() )
								{
									?>
									<li class="nav-item" >
									  <a class="nav-link" href="user_create.php">Crear Usuario</a>
									</li>
									<?php
								}
							?>
							
						  <?php
						  if(
							$Model->Type == 1
							&& $Model->HasTeamCreate() 
							)
							  {
								  /*
								  ?>
								  <li class="nav-item" ><a  class="nav-link" href="teams.php">Equipos</a></li>
								  <?php
								  */
							  }							
						  ?>
						  
						  <?php
						  $tareasCompletadas = 0 ;
						  $tareasPendientes = 0 ;
						  foreach($Model->Projects as $projecto )
						  {
							  foreach($projecto->Tasks as $tarea)
							  {
								  if($tarea->Completed == true)
								  {
									  $tareasCompletadas++;
								  }
								  else
								  {
									  $tareasPendientes++;
								  }
							  }
						  }
						  
						  ?>
						  <!--<li class="nav-item" >
						  <small >Tareas Completadas: <b><?php echo $tareasCompletadas; ?></b> 
							<br>Tareas Pendientes: <b><?php echo $tareasPendientes; ?></b> 
						  </small>
						  </li>
						  -->
						  
						</ul>
					  
						<?php

						if( $Model->Type==2 )
						{
							
							?>
							<div style="text-align:left;">
							<link rel="stylesheet" type="text/css" href="Partials.css">
							<a class="nav-link " style="width: 200px; color: #007bff;width:200;border:1px solid red; background-color:black;animation: blinker 5s ease infinite;" target="_blank" href="https://josemayorga.com">..::JOSEMAYORGA.COM::..</a>
							</div>
							<?php
						}

					}
					
					?>
					
				  
				  </div>
				</div>
				<div class="collapse navbar-collapse" id="navbarResponsive" style="/*border:1px solid red;*/">
					<ul class="navbar-nav ml-left" style="/*border:1px solid red; */width: 200px;" >
					<li class="nav-item">
							<p>
							<small>
						Bienvenido <b><?php echo$Model->ArtistName ;  ?></b>
							<br>User Id: <b><?php  echo $Model->Id ;   ?></b>
							<br> Versión del sistema: <b><?php echo $Model->Type == 2 ? "Basic" : "Pro" ; ?></b> 
							
							<?php
								if( $Model->Type==2 )
								{
									?>
									
									  <a class="nav-link " style="color: #007bff;width:200;border:1px solid red;" href="user_upgrade.php?uid=<?php echo $Model->Id ; ?>">Versión Pro sin publicidad</a>
									
									<?php
								}
								else
								{
									include_once("HtmlHelper.php");
									$hoy =  strtotime(HtmlHelper::getHoraServidor());
									//echo "*". $hoy ."*" . ":" . HtmlHelper::getHoraServidor();
									$finLicencia = strtotime($Model->Licencia->EndDate);
									//echo "*". $finLicencia ."*" . $Model->Licencia->EndDate;
									//echo "*". time($finLicencia) < time($hoy) ."*";
									if($finLicencia > $hoy )
									{
										$licenciaValida = 1;
									}
									else
									{
										$licenciaValida = 0;
									}
									//$licenciaValida = ($hoy > $finLicencia );
									//echo "***". $licenciaValida ."***";
									if($licenciaValida == 0
									//|| true
									)
									{
										$Model->Licencia->ExpirarLicencia();
									}




									?>
									<br> Licencia expira en: <b><?php echo  $Model->Licencia->EndDate == null ? '01-jan-2050': date("d-M-Y", strtotime($Model->Licencia->EndDate )); ?></b> 
									<?php
									if( ! $Model->Licencia->Activa )
									{
										?>
									
									  <a class="nav-link " style="color: #007bff;width:200;border:1px solid red;" href="user_upgrade.php?uid=<?php echo $Model->Id ; ?>">Versión Pro sin publicidad</a>
									
									<?php
									}


								}
							?>
							</small>
							</p>
						  </li>
							
					
					</ul>
					<div>
					<div class="collapse navbar-collapse" id="navbarResponsive" style="/*border:1px solid red;*/">
					<ul class="navbar-nav ml-auto" >
					
							<li class="nav-item">
								<a class="nav-link" href="utils/auth/logout.php"><img src="img/logout-color.png"></a>
							</li>
					
					</ul>
					<div>
				</div>
			  </nav>
			
			<?php
		
		break;
		case "partial-footer":
			?>
			<!-- Footer -->
			  <footer class="py-5 bg-dark">
				<div class="container">
					<ul class="text-center mb-2">
						<li class="list-inline-item">
						  <a href="#">Conocer mas</a>
						</li>
						<li class="list-inline-item">&sdot;</li>
						<li class="list-inline-item">
						  <a href="#">Contacto</a>
						</li>
						<li class="list-inline-item">&sdot;</li>
						<li class="list-inline-item">
						  <a href="#">Términos de uso</a>
						</li>
						<li class="list-inline-item">&sdot;</li>
						<li class="list-inline-item">
						  <a href="#">Política de uso de datos</a>
						</li>
					  </ul>
				  <p class="m-0 text-center text-white">&copy; mistareas.com.mx 2020. Todos los derechos reservados.</p>
				</div>
				<!-- /.container -->
			  </footer>
			<?php
		break;
		case "partial-task-display":
			include_once("task_displayModel.php");
			$_GET["t"] = $Model->Id ; 
			$_GET["uid"] = $_SESSION["User"]["id"];
			
			$Model2 = new task_displayModel($Model->Id, $_GET["uid"]);
			?>
			
			
			<div class="card">
				<div class="card-header" role="tab" id="headingOne">
					<a
			name="ancla-task-<?php echo $Model->Id ; ?>"
			 ></a>
				  <h5 class="mb-0" ref="<?php echo $Model->Id ; ?>">
				  
				    <?php
					if($_SESSION["User"]["type"] == 1
						&& $_SESSION["User"]["id"] == $Model2->TaskOwner
					)
					{
						?>
						
						
						<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo<?php echo $Model->Id ; ?>" aria-expanded="false" aria-controls="collapseTwo<?php echo $Model->Id ; ?>"><img src="img/left-color.png" /></a>
						
						
						
						
						<?php
					}
					?>
				  
				  
					
					
					
					<a 
					
					data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $Model->Id ;?>" 
					<?php 
					if ( isset($_GET["ariaExpanded"]) && $_GET["ariaExpanded"] === $Model->Id  ) 
						{
							?>
							aria-expanded="true"
							
							<?php
						} 
						else 
						{
							?>
							aria-expanded="false"
							
							<?php
						}

					?>
					
					
					aria-controls="collapse<?php echo $Model->Id ;?>">
					<?php echo $Model->Name ; ?>
					</a>
					<?php
					if( $_SESSION["User"]["id"] == $Model2->TaskOwner
						
					)
					{
						
							if($Model->Completed 
				  
							  )
								{
									?>
									<img  src="img/flag-color.png" width="64" /><a href="task_undo.php?t=<?php echo $Model->Id ; ?>"><img  src="img/undo.png" width="24" /></a>
									<!-- <img class="chk_completed"  src="img/flag-color.png" width="64" /> -->
									<?php
								}
								else
								{
									?>
									<input 
										type="checkbox" 
									
									
									class="chk_completed" <?php  echo $Model->Completed == true ? "checked" : "" ; ?>
										/>
									
									<?php
								}
						
					}
				  
				  ?>
				  </h5>
				  
				</div>

				<div id="collapse<?php echo $Model->Id ;?>" class="<?php echo (isset($_GET["ariaExpanded"]) && $_GET["ariaExpanded"] == $Model->Id  ) ? "collapse show": "collapse"?>" role="tabpanel" aria-labelledby="heading<?php echo $Model->Id ;?>">
				  <div class="card-body">
					
					<?php
					include("service_task_display.php");
					?>
					
					
				  </div>
				  <div class="card-header text-center">
					
					<a class="btn btn-secondary"
					
					data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $Model->Id ;?>" 
					aria-controls="collapse<?php echo $Model->Id ;?>">
					OCULTAR RECURSOS DE LA TAREA "<?php echo $Model->Name ; ?>"
					</a>
					
					
					
				</div>
				</div>
				
				
				
				<?php
					if($_SESSION["User"]["type"] == 1
						&& $_SESSION["User"]["id"] == $Model2->TaskOwner
					)
					{
						?>
						
						
						
						
						
						
						<div id="collapseTwo<?php echo $Model->Id ; ?>" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
						  <div class="card-body">
							<h5>ACCIONES DISPONIBLES PARA LA TAREA: <small><?php echo $Model->Name ; ?></small></h5>
							<div class="tasks-list-item-actions row">
								
								
								<div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
									<div class="card h-100">
									  <!--
									  <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
									  -->
									  <div class="card-body">
										<h4 class="card-title">
										  RENOMBRAR
										</h4>
										<div class="card-text">
										
											<form action="task_edit.php" method="post">
												<input type="hidden" value="<?php echo $Model->Id ; ?>" name="taskid" />
												<input type="text"  class="form-control form-control-lg" name="newName" value="<?php echo $Model->Name ; ?>" />
												<br />
												<br />
												<input type="submit" value="Continuar" name="edit-task" class="btn btn-success" />
											</form>
										
										
										</div>
									  </div>
									</div>
								</div>
								
								<div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
									<div class="card h-100">
									  <!--
									  <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
									  -->
									  <div class="card-body">
										<h4 class="card-title">
										  BORRAR
										</h4>
										<p class="card-text">
										
											<a class="btn btn-danger" href="task_delete.php?t=<?php echo $Model->Id ; ?>"> Borrar </a>
										
										
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
										
										
											<img class="img-chrono" src="img/chrono-color.png" /> 
										
										
										
									  </div>
									</div>
								</div>
								
								<div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
									<div class="card h-100">
									  <!--
									  <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
									  -->
									  <div class="card-body">
											
											
											
											<img class="img-share" src="img/share-color.png" /> 
											<?php
												renderPartialShareTaskPanel($Model2);
											?>
										
										
									  </div>
									</div>
								</div>
								
								
								<div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
									<div class="card h-100">
									  <!--
									  <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
									  -->
									  <div class="card-body">
											<h4 class="card-title">
											  Transferir a otro Proyecto
											</h4>
										
											
											
											<?php
											include_once("task_transferModel.php");
											$Model3 = new task_transferModel($Model->Id);
											renderPartialTransferTaskForm($Model3);
											?>
										
										
									  </div>
									</div>
								</div>
								
								
							
							</div>
							
						
						  </div>
						  <div class="text-center">
						  <a class="collapsed " data-toggle="collapse" data-parent="#accordion" href="#collapseTwo<?php echo $Model->Id ; ?>" aria-expanded="false" aria-controls="collapseTwo<?php echo $Model->Id ; ?>">
  							<img src="img/left-color.png" />
	  					  </a>
						  </div>
						  
						</div>
				
			  </div>
						
						
						
						
						
						<?php
					}
					?>
				
			


			
			<?php
		break;
		case "partial-tasks":
		if(!isset($Model))
		{
			?>
			<p>
			<h1>
			Página de ayuda de mistareas.com.mx
			</h1>
			<?php
			
			$actions = ["home",  "help", "menuproject","addproject", "add","left" ,"delete", "edit", "hide", "chrono", "aula", "share", "transfer", "logout"];
			$descriptions = ["Inicio",  "AYUDA", "Mostrar/Ocultar Proyectos","Agregar Proyecto", "Agregar Tarea","Mostrar/ocultar Acciones","Borrar", "Renombrar", "Ocultar formulario", "FUNCIONES DE TIEMPO", "APOYOS DIGITALES","Asignar a otro Usuario", "Transferir de Proyecto", "Salir"];
			$i = 0 ;
			foreach($actions as $action)
			{				
				?>
				<br />				
				<br />				
				<span style=" margin: 15px;">
				<?php echo  $i  + 1  ; ?>.- 
				<?php echo $action ;?>-color.png : <img width ="45" src="img/<?php echo $action ;?>-color.png"  />
				: <?php echo $descriptions[$i]?>
				</span>
				
				<?php
				$i++;
			}
			
			?>
			
			
			<br /><br />
			</p>
			<?php
			
		}
		else
		{
			?>
			<div id="project-header" class="tasks-list-header">
			<h1 style="display:inline;">
				<?php 
					echo "Proyecto: " . 
					$Model->Name ; 
				?>
			</h1>
				<?php
					if ( $Model->Id != -1 )
					{
						?>
						<a href="project_edit.php?p=<?php echo $Model->Id ; ?>"><img  class="img-edit" src="img/edit-color.png"></a>
						<a href="project_delete.php?p=<?php echo $Model->Id ;?>"><img   class="img-delete" src="img/delete-color.png"></a>
						<!-- <img class="img-pdf" src="img/pdf-color.png" /> -->
						<?php
					}
				?>
			</div>
			<div id="tasks" style="height: 375px; width: 1067px;overflow:scroll;">
			
			
					
			
			
			
				<?php				
					foreach($Model->Tasks as $task)
					{
						if($Model->Id == -1)
						{
							Partial("partial-task-display", $task, "-1");
						}
						else
						{
							Partial("partial-task-display", $task, "");
						}					
					}
					?>
			</div>
			
				<div class="tasks-list-actions" id="task-add-button">
						<?php
						if($Model->Id != -1)
						{
							?>
							<img src="img/add-color.png" class="img-add" />
							<?php
						}
						?>						
				</div>
			<?php
			
		}
		
		break;
		case "partial-task-add":
		/* El Model es un Objeto de tipo Project
		*/
		?>
		<div style="display:none; border: 1px solid black ; margin-top:10px ; padding:10px ;  " id="task-add-form" >
			<h3 >
				Creando Tarea para el Proyecto <b><?php echo $Model->Name ; ?></b>
			</h3>
			<table>
			<tr>
				<th>Descripción</th>
				<th>¿Completada?</th>
				
			</tr>
			<tr>
				<td><input type="text" id="description" name="description"></td>
				<td><input type="checkbox" id="done" name="done"></td>	
				<td>
					<input type="button" value="Crear" name="add" id="add" />
					<input type="hidden" name="ddl_projectid" id="ddl_projectid" value="<?php echo $Model->Id ; ?>"  />
				</td>
			</tr>
		</table>
		<div style="text-align:center;"  ><img id="hide-task-form-button" class="img-up" src="img/up-color.png" /></div>
		</div>
		
		<?php
		break;

	}// end switch
}

function renderPartialShareTaskPanel($Model)
{
	// include_once("task_transferModel.php");
	// $modell = new task_transferModel($Model->Id);
	?>
	

	
	
	
	
	<div class="task-assign-user-container" style="display:none;" ref="<?php echo $Model->Task->Id ; ?>">
		<form action="task_edit.php" method="post">
			<input type="hidden" value="<?php echo $Model->Task->Id ; ?>" name="taskid" />
			
			<br />
			<input readonly
			 style="cursor:pointer;" class="form-control form-control-lg" placeholder="Buscar..."  name="assigned-userid"
			 data-toggle="modal"  data-target="#exampleModal" 
			data-whatever2="<?php echo $Model->Task->Name ; ?>"
			data-whatever='
			<?php
				
				
				include_once("partial-usuarios_noasignadosModel.php");
				$Model4 = new usuarios_noasignadosModel($Model->Task->Id);
				$CandidatosValidados = array();
				if($Model4->Users != null)
				{
					if(count($Model4->Users) > 0 )
					{
						
						$CandidatosValidados = $Model4->Users ;
						// foreach($Model4->Users as $candidatoNoVerificado)
						// {
							// if($candidatoNoVerificado->Friends !== null)
							// {
								// foreach($candidatoNoVerificado->Friends as $amigoPotencialDeCandidato)
								// {
									// if($amigoPotencialDeCandidato->Id == $Model->TaskOwner)
									// {
										// $CandidatosValidados[] = $candidatoNoVerificado ;
										// break ; 
									// }
								// }
							// }
							
						// }
						
						
						$contadorCandidatos = count($CandidatosValidados);
						// foreach($Model4->Users as $candidato)
							// {
								// echo $candidato->Name . "(" . $candidato->Id  . ")";
								// if($contadorCandidatos > 1)
								// {
									echo json_encode($CandidatosValidados);
								// }
								// $contadorCandidatos--;
							// }
					}
				}
				
				
				
				
			?>
			' />
			<input class="btn btn-success" type="submit" value="Asignar" disabled="disabled" name="edit-task" />
			<input type="button" class="btn btn-secondary btn-share-cancel"  value="Cancelar" />
			
			
		</form>
		
		
            <?php
			
				include_once("partial-usuarios_asignadosModel.php");
				$Model3 = new usuarios_asignadosModel($Model->Task->Id);
				if($Model3->Users != null)
				{
					if(count($Model3->Users) > 0 )
					{
						
						renderPartialUsuariosAsignados($Model3);
					}
				}
			?>
	</div>
	
	<?php
}

function renderPartialTransferTaskForm($Model)
{
	//$Model = getTransferTaskFormModel($TaskId);
	?>
	<?php
	if(count($Model->Projects) > 2)
	{
		?>
		
			<form action="task_edit.php" method="post" >
				<input type="hidden" value="<?php echo $Model->Task->Id ; ?>" name="taskid" />
				<input type="hidden" value="transferir" name="transferir" />
				
				<select name="projectid" class="form-control form-control-lg projectid"
				
				>				
					<option value="<?php echo $Model->Task->ProjectId ; ?>" >Seleccione un Proyecto...</option>
					<?php
					$assignedTasksProjectId = -1 ; 
					foreach($Model->Projects as $Project)
					{
						if($Project->Id != $assignedTasksProjectId)
						{
							if( $Model->Task->ProjectId != $Project->Id )
							{
								?>
								<option value="<?php echo $Project->Id ; ?>">
								<?php 
								echo strlen($Project->Name) < 13 ? $Project->Name : substr(trim($Project->Name), 0, 10) . "..." ;  echo $Model->Task->ProjectId == $Project->Id ? "(ACTUAL)" : "" ; 
								?>
								</option>
								<?php
							}						
						}					
					}
					?>
				</select>
				<br />
				<br />
				<input class="btn btn-success" type="submit" value="Transferir" name="transferir" class="transferProject" />
			</form>
		
	<?php
	}
	else
	{
		?>
		<div class="task-transfer-container" ref="<?php echo $Model->Task->Id ; ?>">
		NO HAY PROYECTOS DISPONIBLES PARA TRANSFERIR.
		</div>
		<?php
		
	}
	?>
	
	<?php
}

function getTransferTaskFormModel($TaskId)
{
	include_once("task_transferModel.php");
	$model = new task_transferModel($TaskId);
	return $model ;
	
}


function renderPartialUsuariosAsignados($Model)
{
	?>	
				
				
	<div class="card">
        <div class="card-header" role="tab" id="headingThree">
          <h5 class="mb-0">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree<?php echo $Model->Task->Id ; ?>" aria-expanded="false" aria-controls="collapseThree<?php echo $Model->Task->Id ; ?>">
			Asignado a:
            </a>
          </h5>
        </div>
        <div id="collapseThree<?php echo $Model->Task->Id ; ?>" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
          <div class="card-body">
		  
			<ul>
	
				<?php
					foreach($Model->Users as $User)
					{
						?>
						<li><?php echo $User->Id ; ?> - <b><?php echo $User->Name ; ?></b><span class="btn-warning task-unassign" ref1="<?php echo $User->Id ; ?>" ref2="<?php echo $Model->Task->Id ; ?>" style="cursor:pointer;">[X]</span></li>
						<?php
					}
					?>
			</ul>
			
          </div>
        </div>
      </div>			
				
				
	
	

	<?php
}





function renderPartialUserFriends($User)
{
	?>
	
	
	<ul>
	<?php
	if($User->Friends != null)
	{
		foreach($User->Friends as $friend)
		{
			?>
			<li><?php echo "[" . $friend->Id . "] " .$friend->ArtistName ; ?>
			
			<?php
			renderConectUsersButton($User, $friend, "desconectar", "Desconectar", "danger");
			?>
			</li>	
			<?php
		}
	}
	?>
	</ul>
	
	<?php
}


function renderPartialUserNotFriends($User)
{
	?>
	
	<ul>
	<?php
	foreach($User->NotFriends as $friend)
	{
		$match = false ; 
		
		
		if($User->Type == 1
			|| $User->getConnectionStatus($friend->Id) == "recibida")
		{
			?>
		<br />
		<li><?php echo "[" . $friend->Id . "] <b>" . $friend->Name . "</b>"; ?>	
		<?php
		}
		
			
			if($User->getConnectionStatus($friend->Id) == "enviada")
			{
				$match = true ;
				?>
				(Solicitud enviada)
				<?php
				renderConectUsersButton($User, $friend, "desconectar", "Cancelar la solicitud", "danger");
			}
			elseif($User->getConnectionStatus($friend->Id) == "recibida")
			{
				?>
				(Este usuario te ha agregado)  
				<?php
				renderConectUsersButton($friend, $User, "aceptar", "Aceptar", "success");
				renderConectUsersButton($friend, $User, "desconectar", "Ignorar solicitud", "danger");
			}
			else
			{
				if($User->Type == 1)
				{
					renderConectUsersButton($User, $friend, "solicitar", "Conectar", "primary");
				}

				
			}
	
		?>
		</li>
		<?php
	}
	?>
	</ul>
	
	<?php
}

function renderConectUsersButton($user1, $user2, $action, $label, $css_class)
{
	?>
	<a href="user_connect.php?action=<?php echo $action ; ?>&userid1=<?php echo $user1->Id ; ?>=&userid2=<?php echo $user2->Id?>" class="btn btn-<?php echo $css_class?> " /><?php echo $label ; ?></a>
	<?php
}



function renderPartialUserRequests($User)
{
	?>
	<ul>
	<?php
	foreach($User->NotFriends as $friend)
	{
		?>
		<li><?php echo "[" . $friend->Id . "] " .$friend->Name ; ?>
		<form action="user_connections.php" method="post">
		</form>
		</li>
		<?php
	}
	?>
	</ul>
	<?php
}


?>
