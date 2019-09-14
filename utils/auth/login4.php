<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
	body{
		background-image: url('../../img/fondo-01.png');
		background-position:center top;
		background-repeat:no-repeat;
		/*border: 5px solid red ;*/
	}
	</style>
    <title>mistareas.com.mx</title>
  </head>
  <body>
  <center>
	<div class="container" style=" margin-top:105px; width:1070px;">
		<?php
		$headerFile = "../header-david.php";
		// needed in the included file
		$callingFromLogin = true ; 
		$callingFromLevelUp = false ; 
		include_once($headerFile);
	  ?>
	  
	  <div class="row">
		
		<div class="col" style="min-width:800px; padding-top:50px;" >
		
			
		<table  >
			<tr>
				<th>Bienvenido a mistareas.com.mx</th>
			</tr>
		</table>
		<table  border>
			<tr width="50%">
				<td>
				<form action="login3.php" method="post" name="form_login">
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
				</td>
			</tr>
			
		</table>
		El Uso de esta aplicacion es entera responsabilidad del Usuario. La Página esta sujeta a cambios sin previo aviso.	
		
		
		</div>
	  </div>
	  
	  </center>
	  
	  
	  <?php
	  include_once("../footer-david.php");
	  ?>
	  
	</div>
		
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </body>
</html>
