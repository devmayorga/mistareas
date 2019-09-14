<?php
include_once("User.php");
include_once("todolistModel.php");
include_once("Partials.php");
session_start();

//
if(!isset($_SESSION["User"]))
{	
	$userid = 0 ; 
}
else
{
	$userid = $_SESSION["User"]["id"];
}


try{
$Model = new todolistModel($userid);
/*A estas alturas del partido. Si el Usuario no tiene Id es porque caducó la sesion.*/
if(strlen($Model->User->Name) < 1)
{
  ?>
  <script language="javascript">
  window.location.href="sesionExpirada.php";
  </script>
  <?php
}
}
catch(Exception $e) {
	echo "AS";
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
	$currentProject = null ;	
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
	<br>
    <!-- Page Heading/Breadcrumbs -->
	<?php
	if($currentProject===null)
	{
		header("location:home.php");
	}
	?>
    <h1 class="mt-4 mb-3">
		<?php echo $currentProject->Name  ; ?>
      <small>
		
		<?php
			if ( $currentProject->Id != -1 )
			{
				?>
				<a href="project_edit.php?p=<?php echo $currentProject->Id ; ?>">editar</a>
				<div class="tasks-list-actions" id="task-add-button" style=" width:2em ; display:inline;">
						<?php
						if($currentProject->Id != -1)
						{
							?>
							<img src="img/add-color.png" class="img-add" style=" width:3em ;" />
							<?php
							
						}
						?>						
				</div>
				<!-- <img class="img-pdf" src="img/pdf-color.png" /> -->
				<?php
			}
		?>
	  </small>
    </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="home.php">Inicio</a>
      </li>
      <li class="breadcrumb-item "><a href="home.php">Proyectos</a></li>
	  <li class="breadcrumb-item active"><?php echo $currentProject->Name ; ?></li>
      
	  
	  
	  
    </ol>
	
	<?php
	Partial("partial-task-add", $currentProject, "");
	?>

    <div class="mb-4" id="accordion" role="tablist" aria-multiselectable="true">
      
	  <?php
		foreach($currentProject->Tasks as $task)
		{
			
			
			  Partial("partial-task-display", $task, "");
			
			
			
		}
	  
	  ?>
	  
	  
	  
	  <!--
	  <div class="card">
        <div class="card-header" role="tab" id="headingOne">
          <h5 class="mb-0">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Collapsible Group Item #1</a>
          </h5>
        </div>

        <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
          <div class="card-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
          </div>
        </div>
      </div>
	  
	  
	  
      <div class="card">
        <div class="card-header" role="tab" id="headingTwo">
          <h5 class="mb-0">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Collapsible Group Item #2
            </a>
          </h5>
        </div>
        <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
          <div class="card-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" role="tab" id="headingThree">
          <h5 class="mb-0">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Collapsible Group Item #3</a>
          </h5>
        </div>
        <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
          <div class="card-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
          </div>
        </div>
      </div>
    
	
	
	-->
	</div>

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
		
		
		
		/*** share button********/
	
		$(".img-share").click(function(){
			assignForm = $(this).parent().parent().find('.task-assign-user-container') ;
			// Checks css for display:[none|block], ignores visibility:[true|false]
			if(assignForm.is(":visible"))
			{
				assignForm.hide();
			}
			else
			{
			// The same works with hidden
			assignForm.is(":hidden");
			$(assignForm).show();
			}
		});
		/************************/
		
		
		/*** completed checkbox */
		$('.chk_completed').click(function(){
			
			var id = $(this).parent().attr('ref') ;
			var done = 1 ; 
			var parent = $(this).parent();
			$(this).hide();
			/*if(done == 1)
			{
				$(this).parent().parent().attr("style", "background-color:#DCF0F7;");
			}
			else
			{
				$(this).parent().parent().attr("style", "background-color:white;");
			}*/
			//alert("id: " + id + "done" + done);
			$.ajax({
				type: "POST",
				url: "task_update.php",
				data: "id=" +id + "&done="+ done ,
				success: function(msg){
					//alert("tarea actualizada");
					parent.append('<img  src="img/flag-color.png" width="64" /><a href="task_undo.php?t='+ id +'"><img  src="img/undo.png" width="24" /></a>');
				}
			});
		});
		/************************/
		
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
	$('#add-project-button').hide();
	$('#description').focus();
	
	
	/************** Task Item actions *******************/
	
		 activateTaskItemActions();
	
	
	/****************************************************/
	
	
	
	
	/*** transfer button********/
	
	$(".img-transfer").click(function(){
		transferForm = $(this).parent().parent().find('.task-transfer-container') ;
		// Checks css for display:[none|block], ignores visibility:[true|false]
		if(transferForm.is(":visible"))
		{
			transferForm.hide();
		}
		else
		{
		// The same works with hidden
		transferForm.is(":hidden");
		$(transferForm).show();
		}
	});
	/************************/
	
	<?php
	$actions = ["delete", "edit", "add","addproject", "hide", "logout", "chrono", "aula", "menuproject", "home", "pdf", "share", "up", "transfer"];
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
		$(this).parent().parent().find("#projectslist").show();
		$("#add-project-button").show();
		$(this).hide();
	});
	
	$("#project-menu-hide").click(function(){
		$(this).parent().hide();
		$("#add-project-button").hide();
		$(this).parent().parent().find("#img-project-menu").show();		
	});
	
	$("#add-project-button").click(function(){		
		$("#create-new-project-form").show();
		$(this).hide();
	});
	$("#hide-project-button").click(function(){		
		$("#create-new-project-form").hide();
		$("#add-project-button").show();
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

	
	
	$('.transferProject').click(function(){
		var id = $(this).parent().parent().attr('ref') ;
		var newProjectId = $(this).parent().find('.projectslist').find(":selected").val();
		var tareaTransferida = $(this).parent().parent().parent().parent();
		// alert(tareaTransferida.html());
		$.ajax({
			type: "post",
			url: "task_edit.php",
			data: "transferir=transferir&taskid=" +id + "&projectid="+ newProjectId ,
			success: function(msg){
				tareaTransferida.html(msg);
				
			}
		});
	});
	
	

	$('#add').click(function(){
		var description = $('#description').val() ;
		var done = $('#done').prop('checked') ? 1 : 0 ;
		//alert($("#done").prop("checked"));
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
				
				$('#accordion').append(msg);
				/****
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
				****/
				//alert("activar funciones de items");
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
		//$(this).parent().parent().parent().hide();
		$('#create-new-project-form').hide();
		$.ajax({
			async: false,
			type: "POST",
			url: "project_add.php",
			data: "name=" +name  ,
			success: function(msg){
				$('#projectname').val('');				
				//$('#projectslist').append(msg);
				// Begin test case [ 1 ] : Exist a childElement --> All working correctly
				var sp2 = $("#add-project-button");
				$('#projectslist').insertBefore(msg, sp2);
			}
		});
		
	});

});

</script>



</body>

</html>
