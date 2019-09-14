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





<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8"> 	

<script type="text/javascript" src="jquery-1.7.1.min.js"></script>  
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

<style>
body{
	background-image: url('img/fondo-01.png');
	background-position:center top;
	background-repeat:no-repeat;
	/*border: 5px solid red ;*/
}
</style>
<link rel="stylesheet" type="text/css" href="Partials.css">
  
  
  
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>mistareas.com.mx</title>
  </head>
  <body>
  
	<div class="container" style="margin-top:105px; width:1070px;">
		<?php
		  $headerFile = "utils/header-david.php";
		  // needed in the included file
		  $callingFromLevelUp = true ; 
		  include_once($headerFile);
		?>
	  
	  <div class="row">
		
		<div class="col" style="min-width:800px; padding-top:50px;" >
		
		
		
		
			
			<?php
				if(isset($currentProject))
				{
					if(is_null($currentProject))
					{
						$projectId = 0 ;
					}
					else
					{
						$projectId = $currentProject->Id ;
					}
				}
				else
				{
					$projectId = -1 ;
					$currentProject = null ;
				}

				//Partial("partial-displayprojects-small", $Model->User, $projectId );
				?>
				<?php
				Partial("partial-tasks", $currentProject, "css-tasks");
				?>
				<?php
				Partial("partial-task-add", $currentProject, "");
				?>
				<?php
				Partial("partial-footer", $Model->User, "css-footer" );
				?>
		
	
		
		
		
		</div>
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
  </body>
</html>
