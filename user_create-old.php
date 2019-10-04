
<?php
include("db/dal.php");
if($Model->User->Type != 1)
{
	?>
	CUENTA NO VALIDA PARA ESTA ACCION
	<?php
	die();
}



	if (! ( isset($_POST["txt_user"]) && isset($_POST["txt_pass"]) && isset($_POST["send"])    )    )
{
	// - - - > If error message is set... Display message to the user
	if (isset($_GET["msg"]))
	{
		// - - - > $ErrorMessage is defined in enums.php (Look at the bottom of this file)
		//echo $ErrorMessage[1] ;
		echo "Error";
		
	}
	?>
	
		
		
		<h3>Crear Usuario</h3>
		
		
		
				<form action="user_create.php" method="post" name="form_login">
					<table>	
						<tr>
							<td>&nbsp;</td>
							<td>ESCRIBA UN NUEVO NOMBRE DE USUARIO Y CONTRASEÑA.</td>
						</tr>
						<tr>
							<th>User</th>
							<td><input type="text" name="txt_user" id="txt_user" /></td>
						</tr>
						<tr>
							<th>Password</th>
							<td><input type="text" name="txt_pass" id="txt_pass" /></td>
						</tr>
						<tr>
							<td></td>
							<td><input class = "btn btn-success" type="submit" value="Crear" name="send" id="btn_send" /> <a href="home.php" class="btn btn-secondary" >Cancelar</a>
							
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
						</tr>
					</table>
					
					<input type="hidden" name="appid" value="<?php echo $_GET["appid"]?>" />
					
				</form>
				
		<p>
		Al crear una Cuenta  generará un código de Usuario que es el que deberá utilizar para poder asignar tareas dentro del Sistema.
		</p>
	
	
	<?php
}
else
// - - - > Authentication variables were sent by this application
// - - - > Authenticate user
{

	
		$username = $_POST["txt_user"];
		$password = $_POST["txt_pass"];
		if( strlen($username)> 0 && strlen($password) > 0)
		{
	
			$User = createUser($username,$password);
		        if($User["validuser"])
			{
				//$_SESSION["User"] = $User ;
				//echo "User logged";
				?>
				<div class="alert alert-success">
				<h4>USUARIO CREADO!</h4>
				<p>
				Id para asignar tareas: [<?php echo $User["id"]?>] 
				<br>
				Nombre de usuario: [<?php echo $User["username"]?>]
				</p>
				</div>
				<br>
				<div class="btn-group">
					<a class="btn btn-primary" href="user_create.php">Crear Otro usuario</a>
					<a class="btn btn-primary" href="home.php">Ir al sistema</a>
				</div>
				<?php
				//die();
			}
			else
			{
				?>
				<div class="alert alert-warning">
				
				<h4>EL USUARIO [<b><?php echo $username ; ?></b>] YA EXISTE! NO SE PUEDE DUPLICAR!</h4>
				
				</div>
				<br>
				<div class="btn-group">
					<a class="btn btn-primary" href="user_create.php">Intente usando otro nombre de usuario</a>
					<a class="btn btn-secondary" href="home.php">Cancelar</a>
				</div>
				<?php
			}
			
			
		
		}
	
}



?>