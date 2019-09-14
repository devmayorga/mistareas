<?php
function Partial($partialToRender, $Model, $css_class)
{
	switch($partialToRender)
	{
		case "partial-project-thumbnail":
			?>
			<div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
				<div class="card h-100">
				  <!--
				  <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
				  -->
				  <div class="card-body">
					<h4 class="card-title">
					  <a href="todolist.php?p=<?php echo $Model->Id ; ?>">Proyecto: <?php echo $Model->Id < 0 ? "Asignado" : $Model->Id ; ?></a>
					</h4>
					<p class="card-text">
					<?php echo $Model->Name ; ?>
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
				  <div class="collapse navbar-collapse" id="navbarResponsive">
				  
					
					<ul class="navbar-nav ml-auto">
						
					  <li>
					  <small >Bienvenido <b><?php echo $Model->Name ; ?></b> 
						<br>Id de usuario: [<?php echo $Model->Id ; ?>] 
						<br> Tipo de cuenta: <?php echo $Model->Type == 2 ? "Alumno" : "Maestro" ; ?> 
					  </small>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" href="utils/auth/logout.php"><img src="img/logout-color.png"></a>
					  </li>
					<!--
					  <li class="nav-item">
						<a class="nav-link" href="about.html">About</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" href="services.html">Services</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" href="contact.html">Contact</a>
					  </li>
					  <li class="nav-item active dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  Portfolio
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
						  <a class="dropdown-item" href="portfolio-1-col.html">1 Column Portfolio</a>
						  <a class="dropdown-item" href="portfolio-2-col.html">2 Column Portfolio</a>
						  <a class="dropdown-item" href="portfolio-3-col.html">3 Column Portfolio</a>
						  <a class="dropdown-item active" href="portfolio-4-col.html">4 Column Portfolio</a>
						  <a class="dropdown-item" href="portfolio-item.html">Single Portfolio Item</a>
						</div>
					  </li>
					  <li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  Blog
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
						  <a class="dropdown-item" href="blog-home-1.html">Blog Home 1</a>
						  <a class="dropdown-item" href="blog-home-2.html">Blog Home 2</a>
						  <a class="dropdown-item" href="blog-post.html">Blog Post</a>
						</div>
					  </li>
					  <li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  Other Pages
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
						  <a class="dropdown-item" href="full-width.html">Full Width Page</a>
						  <a class="dropdown-item" href="sidebar.html">Sidebar Page</a>
						  <a class="dropdown-item" href="faq.html">FAQ</a>
						  <a class="dropdown-item" href="404.html">404</a>
						  <a class="dropdown-item" href="pricing.html">Pricing Table</a>
						</div>
					  </li>
					  -->
					</ul>
				  
				  
				  </div>
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
				  <p class="m-0 text-center text-white">&copy; mistareas.com.mx 2019. Todos los derechos reservados.</p>
				</div>
				<!-- /.container -->
			  </footer>
			<?php
		break;
		case "partial-task-display":
			include_once("task_displayModel.php");
			$_GET["t"] = $Model->Id ; 
			$_GET["uid"] = $_SESSION["User"]["id"];
			
			$Model2 = new task_displayModel($_GET["t"], $_GET["uid"]);
			?>
			

			<div class="card">
				<div class="card-header" role="tab" id="headingOne">
				  <h5 class="mb-0" ref="<?php echo $Model->Id ; ?>">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $Model->Id ;?>" aria-expanded="false" aria-controls="collapse<?php echo $Model->Id ;?>">
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

				<div id="collapse<?php echo $Model->Id ;?>" class="collapse" role="tabpanel" aria-labelledby="heading<?php echo $Model->Id ;?>">
				  <div class="card-body">
					
					<?php
					include("service_task_display.php");
					?>
					
					<?php
					if($_SESSION["User"]["type"] == 1
						&& $_SESSION["User"]["id"] == $Model2->TaskOwner
					)
					{
						?>
						
						<div class="card">
							<div class="card-header text-center" role="tab" id="headingTwo">
							  <h5 class="mb-0">
								<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo<?php echo $Model->Id ; ?>" aria-expanded="false" aria-controls="collapseTwo<?php echo $Model->Id ; ?>">
								
								<img src="img/left-color.png" />
								
								</a>
							  </h5>
							</div>
							<div id="collapseTwo<?php echo $Model->Id ; ?>" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
							  <div class="card-body">
								<h6><?php echo $Model->Id ; ?> - <small>TAREA: <?php echo $Model->Name ; ?></small></h6>
								<div class="tasks-list-item-actions">
						
									<a href="task_edit.php?t=<?php echo $Model->Id ; ?>"><img class="img-edit" src="img/edit-color.png"></a>
									<a href="task_delete.php?t=<?php echo $Model->Id ; ?>"><img class="img-delete" src="img/delete-color.png"></a>
									<img class="img-chrono" src="img/chrono-color.png" /> 
									<img class="img-share" src="img/share-color.png" /> 
									<a href="task_transfer.php?t=<?php echo $Model->Id ; ?>"><img class="img-transfer" src="img/transfer-color.png" /></a>
									<?php
										renderPartialShareTaskPanel($Model);
									?>
													
								
								</div>
								
								
								
							  </div>
							</div>
						  </div>
						
						
						
						
						
						<?php
					}
					?>
					
					
					
					
				  </div>
				</div>
			  </div>
			


			
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
	<div class="task-assign-user-container" style="display:none;" ref="<?php echo $Model->Id ; ?>">
		<form action="task_edit.php" method="post">
			<input type="hidden" value="<?php echo $Model->Id ; ?>" name="taskid" />
			<input type="textbox" name="assiged-userid"/><input type="submit" value="Asignar" name="edit-task" />
			<!-- <a name="task-assign-user" ><input type="button" value="Buscar usuarios" name="edit-task" /></a> -->
		</form>
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
		<div class="task-transfer-container" ref="<?php echo $Model->Task->Id ; ?>">
			<form action="task_edit.php" method="post" >
				<input type="hidden" value="<?php echo $Model->Task->Id ; ?>" name="taskid" />
				<input type="hidden" value="transferir" name="transferir" />
				
				<select name="projectid" class="projectid">				
					<option value="<?php echo $Model->Task->ProjectId ; ?>" >Seleccione Proyecto receptor y presione "Transferir"</option>
					<?php
					$assignedTasksProjectId = -1 ; 
					foreach($Model->Projects as $Project)
					{
						if($Project->Id != $assignedTasksProjectId)
						{
							if( $Model->Task->ProjectId != $Project->Id )
							{
								?>
								<option value="<?php echo $Project->Id ; ?>"><?php echo trim($Project->Name); echo $Model->Task->ProjectId == $Project->Id ? "(ACTUAL)" : "" ; ?></option>
								<?php
							}						
						}					
					}
					?>
				</select>
				<input type="submit" value="Transferir" name="transferir" class="transferProject" />
			</form>
		</div>
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


?>
