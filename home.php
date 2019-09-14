<?php
session_start();
//
include_once("todolistModel.php");
include_once("Partials.php");
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
?>

<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>mistareas.com.mx</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">


	


</head>

<body>

  <!-- Navigation -->
  <?php
  Partial("partial-navigator", $Model->User , "" ) ;
  ?>

  <!-- Page Content -->
  <div class="container">

    <!-- Page Heading/Breadcrumbs -->
	<br />
    <h1 class="mt-4 mb-3">PROYECTOS
      <!--<small>Proyectos</small>-->
    </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.php">Inicio</a>
      </li>
      <li class="breadcrumb-item active">Proyectos</li>
    </ol>

    <div class="row" id="projectslist">
	
	
		<?php
				foreach($Model->User->Projects as $p)
				{
					Partial("partial-project-thumbnail", $p, "");
				}
		?>
		
		
		
		<?php
		if($Model->User->Type != 2)
		{
			?>
			<div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
				<div class="card h-100">
				  <img src="img/addproject-color.png" class="img-addproject" id="add-project-button" />
				</div>
			</div>
			<div style="display:none;" id="create-new-project-form" style="/*padding-top:15px;*/ margin-top: 15px; padding-left: 15px;  border: 1px solid black ; " class="create-new-project-form col-lg-3 col-md-4 col-sm-6 portfolio-item">
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
			<?php
		}
		?>
		
	
	
    
	</div>

    <!-- Pagination -->
	<!--
    <ul class="pagination justify-content-center">
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
          <span class="sr-only">Previous</span>
        </a>
      </li>
      <li class="page-item">
        <a class="page-link" href="#">1</a>
      </li>
      <li class="page-item">
        <a class="page-link" href="#">2</a>
      </li>
      <li class="page-item">
        <a class="page-link" href="#">3</a>
      </li>
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
          <span class="sr-only">Next</span>
        </a>
      </li>
    </ul>
	-->
  </div>
  <!-- /.container -->

  <?php
  Partial("partial-footer", null, "");
  ?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  
  
  <script type="text/javascript" >

function activateTaskItemActions()
	{
		$('.img-action-left').hover(function(){
			$(this).attr('src','img/left-black.png');
		});
		$('.img-action-left').mouseout(function(){
			$(this).attr('src','img/left-color.png');
		});
		
		$('.img-action-left').click(function(){		
			$(this).parent().parent().find('.tasks-list-item-actions').show();
			
			var rightArrow = $(this).parent().parent().find('.img-action-right');
			rightArrow.show();
			$(this).hide();
			
			
			$('.img-action-right').hover(function(){
				$(this).attr('src','img/right-black.png');
				
			});
			$('.img-action-right').mouseout(function(){
			$(this).attr('src','img/right-color.png');
			});
			
			
			
			rightArrow.click(function(){		
				$(this).parent().parent().find('.tasks-list-item-actions').hide();
				var leftArrow = $(this).parent().parent().find('.img-action-left');
				leftArrow.show();
				$(this).hide();			
			});
			
			
			
		});
	}
	

$(document).ready(function(){

	$('#description').focus();
	
	
	/************** Task Item actions *******************/
	
		 activateTaskItemActions();
	
	
	/****************************************************/
	
	<?php
	$actions = ["delete", "edit", "add","addproject", "hide", "logout", "chrono", "aula", "menuproject", "home"];
	foreach($actions as $action)
	{
		?>
		$('.img-<?php echo $action ;?>').hover(function(){
		$(this).attr('src','img/<?php echo $action ;?>-black.png');
		});
		$('.img-<?php echo $action ;?>').mouseout(function(){
			$(this).attr('src','img/<?php echo $action ;?>-color.png');
		});
		<?php
	}
	?>
	
	
	
	
	$("#img-project-menu").click(function(){
		$("#projectslist").show();		
		$("#add-project-button").show();
		$(this).hide();
	});
	
	$("#project-menu-hide").click(function(){
		$(this).parent().hide();
		$("#add-project-button").hide();
		$(this).parent().parent().parent().find("#img-project-menu").show();		
	});
	
	$("#add-project-button").click(function(){		
		$("#create-new-project-form").show();
		$("#projectname").focus();
		$(this).parent().parent().hide();
	});
	$("#hide-project-button").click(function(){		
		$("#create-new-project-form").hide();
		$("#projectslist").append($("#add-project-button").parent().parent());
		$("#add-project-button").parent().parent().show();
	});
	
	$("#hide-task-form-button").click(function(){		
		$("#task-add-form").hide();
		$("#task-add-button").show();
	});
	
	$("#task-add-button").click(function(){		
		$("#task-add-form").show();
		$("#description").focus();
		$(this).hide();
	});

	$('.chk_completed').click(function(){
		var id = $(this).parent().attr('ref') ;
		var done = $(this).attr('checked') ? "1" : "0" ;
		if(done == 1)
		{
			$(this).parent().parent().attr("style", "background-color:#DCF0F7;");
		}
		else
		{
			$(this).parent().parent().attr("style", "background-color:white;");
		}
		$.ajax({
			type: "POST",
			url: "task_update.php",
			data: "id=" +id + "&done="+ done ,
			success: function(msg){
				
			}
		});
	});

	$('#add').click(function(){
		var description = $('#description').val() ;
		var done = $('#done').attr('checked') ? 1 : 0 ;
		var projectid = $('#ddl_projectid').val() ;
		
		if( ! description )
		{
			alert ("Pon una description!");
			$('#description').focus();
			return ;
		}
		$.ajax({
			async: false,
			type: "POST",
			url: "task_add.php",
			data: "description=" +description + "&done="+ done  + "&projectid=" + projectid,
			success: function(msg){
				
				$('#description').val('');
				$('#done').attr('checked', false);
				
				$('#tasks').append(msg);
				$('tr:last').find('.chk_completed').click(function(){
					var id = $(this).parent().parent().attr('ref') ;
					var done = $(this).attr('checked') ? "1" : "0" ;
					
					$.ajax({
						type: "POST",
						url: "task_update.php",
						data: "id=" +id + "&done="+ done ,
						success: function(msg){
							alert(msg);
						}
					});
				});
				activateTaskItemActions();
				
			}
		});
		
	});
	
	$('#addproject').click(function(){
		var name = $('#projectname').val() ;
		
		if( ! name )
		{
			alert ("Pon un nombre de projecto!");
			$('#projectname').focus();
			return ;
		}
		$.ajax({
			async: false,
			type: "POST",
			url: "project_add.php",
			data: "name=" +name  ,
			success: function(msg){
				$('#projectname').val('');				
				$("#create-new-project-form").hide();
				$('#projectslist').append(msg)   ;
				$('#projectslist').append($("#create-new-project-form"))   ;
				$("#create-new-project-form").show();
				$("#projectname").focus();
				//$('#hide-project-button').click();
			}
		});
		
	});

});

</script>
  
  

</body>

</html>
