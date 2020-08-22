<?php
include_once("User.php");
include_once("todolistModel.php");
include_once("Partials.php");
session_start();

//
if(!isset($_SESSION["User"]))
{	
	$userid = 0 ; 
	?>
	<script language="javascript">
	window.location.href="sesionExpirada.php";
	</script>
	<?php
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
	
	<div id="loading" class="containter mt-5" style="text-align:center;">
		<img src="img/giphy.gif" />
	</div>
	<script language="javascript">
		function hideLoader() {
			$('#loading').hide();
			$('#content').show();
		}
		
				
			
		
	</script>
	

  <!-- Navigation -->
	  <?php
	  Partial("partial-navigator", $Model->User , "" ) ;
	  ?>
  
  
  <!-- Page Content -->
  <div class="container" id="content" style="display:none;">
	<br>
    <!-- Page Heading/Breadcrumbs -->
	<?php
	if($currentProject===null)
	{
		header("location:home.php");
	}
	?>
	
	
	<br /><br /><br />
    <h1 class="mt-4 mb-3 text-center">
		<?php echo $currentProject->Name  ; ?>
      <small>
		
		<?php
			if ( $currentProject->Id != -1 )
			{
				?>
				<a href="project_edit.php?p=<?php echo $currentProject->Id ; ?>"><img src="img/left-color.png" /></a>
				
				<!-- <img class="img-pdf" src="img/pdf-color.png" /> -->
				<?php
			}
		?>
	  </small>
    </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        
      </li>
      <li class="breadcrumb-item ">
	  
	  <?php
	 	if ( $currentProject->Id != -1 && $Model->User->Type != 1 )
		 {
			 ?>
			 <a href="home.php">
			 <!-- <img class="img-pdf" src="img/pdf-color.png" /> -->
			 <?php
		 } 
	  ?>
	  
	  Proyectos
	  
	  <?php
	 	if ( $currentProject->Id != -1 )
		 {
			 ?>
			 </a>
			 <!-- <img class="img-pdf" src="img/pdf-color.png" /> -->
			 <?php
		 } 
	  ?>
	  
	  
	  </li>
	  <li class="breadcrumb-item active ">
	  <?php
	  if($currentProject->Id > 0)
	  {
		  ?>
		  <a href="todolist.php?p=<?php echo $currentProject->Id ; ?>"><?php echo $currentProject->Name ; ?>
		   </a>
		  <?php
	  }
	  else
	  {
		  echo $currentProject->Name ; 
	  }
	  ?>	  
	  </li>
		<?php
		if($currentProject->Id != -1)
		{
			?>
			<li id="task-add-button" class="breadcrumb-item" style="color: #007bff ; cursor:pointer;">
			[+]
			</li>
			<?php
			
		}
		?>
    </ol>
	
	<?php
	Partial("partial-task-add", $currentProject, "");
	?>

	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Asignar Usuario</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<p>
			</p>
			<div>
			Nota: Si no aparece el usuario que usted desea, primero verifique que este entre sus conexiones <a href="user_connections.php">Aqui</a>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		  </div>
		</div>
	  </div>
	</div>





    <div class="mb-4" id="accordion" role="tablist" aria-multiselectable="true">
      
	  <?php
		foreach($currentProject->Tasks as $task)
		{
			
			
			  Partial("partial-task-display", $task, "");
			
			
			
		}
	  
	  ?>
	  
	  
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
		
		
		
		/*** unshare button********/
		$('.task-unassign').click(function(){
			var usuarioDesasignado = $(this);
			var usuario  = $(this).attr("ref1");
			var taskid  = $(this).attr("ref2");
			var dataString = "edit-task=1&task-action=unassign&taskid=" + taskid + "&userid="+ usuario ;
			// alert(dataString);
			$.ajax({
				type: "POST",
				url: "task_edit.php",
				data: dataString ,
				success: function(msg){
					alert(msg + ". Para poderlo asignar nuevamente debe refrescar la página.");
					usuarioDesasignado.parent().remove();
					//parent.append('<img  src="img/flag-color.png" width="64" /><a href="task_undo.php?t='+ id +'"><img  src="img/undo.png" width="24" /></a>');
				}
			});
		});
		/************************/
		
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
		
		/*** cancel share button********/
		$(".btn-share-cancel").click(function(){
				$(this).parent().find("input[name='assigned-userid']").val("");
				$(this).parent().find("input[type='submit']").prop("disabled", "disabled");
				$(this).parent().parent().parent().find(".img-share").click();
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
	$("#content").hide();
	
	setTimeout(hideLoader, 1 * 1000);
	$('#exampleModal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget); // Button that triggered the modal
	  var usuariosAsignables ;
	  // alert("*" + button.data('whatever').trim().length + "*");
	  if(  button.data('whatever').trim().length < 1 )
	  {
		  usuariosAsignables = {};
	  }
	  else
	  {
		  usuariosAsignables = JSON.parse(button.data('whatever')); // Extract info from data-* attributes
	  }
	  
	  var tareaNombre = button.data('whatever2') ;// Extract info from data-* attributes
	  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  var modal = $(this);
	  modal.find('.modal-body p').empty();
	  modal.find('.modal-title').text('Seleccione el Usuario a asociar con la Tarea ' + tareaNombre);
	  modal.find('.modal-body p').text("Usuarios disponibles: ");
	  // modal.find('.modal-body p').append("<ul></ul>");
	  $.each(usuariosAsignables, function(key, item){
		modal.find('.modal-body p ').append("<br /><button data-dismiss='modal' class='btn btn-primary candidato' value='"+ item.Id +"'>"+ item.Id + "-" + item.Name +"</button>");  
	  });
	  modal.find(".candidato").click(function(){
		  // alert($(this).val());
		  button.parent().find("input[name='assigned-userid']").val($(this).val());
		  button.parent().find("input[type='submit']").prop("disabled","");
	  });
	  
	  
	})
	
	
	
	
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
