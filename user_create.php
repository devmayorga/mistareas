<?php
session_start();
include("db/dal.php");
//include ("../enums.php");

// - - - > If user is already authenticated
// . . . > Redirect to main page&&!!!!
if (isset($_SESSION["User"]["validuser"])  )
{
	
	header("location: home.php" );
}
// . . . > Check if form was sent from this page (or at least a post with all parameters set)
// - - - > Display login form
elseif (! ( isset($_POST["txt_user"]) && isset($_POST["txt_pass"]) && isset($_POST["send"])    )    )
{
	// - - - > If error message is set... Display message to the user
	if (isset($_GET["msg"]))
	{
		// - - - > $ErrorMessage is defined in enums.php (Look at the bottom of this file)
		//echo $ErrorMessage[1] ;
		echo "Error";
		
	}
	?>
	<div style="width: 50%; margin: 200px auto;">
		
		<table width="100%">
			<tr>
				<th>Crear cuenta en Mis tAreAs</th>
				<th>Nuestros Patrocinadores</th>
			</tr>
		</table>
		<table width="100%" border>
			<tr width="50%">
				<td>
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
							<td><input type="submit" value="Crear" name="send" id="btn_send" /> o bien 
							<a href="index.php">Acceder aquí</a> con un usuario existente
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
						</tr>
					</table>
					
					<input type="hidden" name="appid" value="<?php echo $_GET["appid"]?>" />
					
				</form>
				</td>
				<td width="50%">
				<p>
				<ul>
					<li><a href="http://www.incubadoradetalento.com" target="_blank">Incubadora TALENT</a></li>
					<li><a href="https://josemayorga.com">josemayorga.com</a></li>
				</ul>
				</p>
				</td>
			</tr>
			
		</table>
		<p>
		Al crear una Cuenta usted tendrá un código de Usuario que es el que debe dar a Conocer a sus Maestros para que le puedan asignar 
		tareas dentro del Sistema.
		</p>
	</div>
	
	<?php
}
else
// - - - > Authentication variables were sent by this application
// - - - > Authenticate user
{

	// - - -> Here is where all common user information is holded
	// - - - ! Check parameters were sent correctly

	// - - - ! Start a fake session
	//~ if($_POST["appid"] == "todolist")
	//~ {
	
	
		$username = $_POST["txt_user"];
		$password = $_POST["txt_pass"];
		if( strlen($username)> 0 && strlen($password) > 0)
		{
			// dal.authenticateUser(str,str)
			// $User = authenticateUser($username,$password);
			$User = createUser($username,$password);
		        if($User["validuser"])
			{
				$_SESSION["User"] = $User ;
				//echo "User logged";
				header("location: todolist.php" ) ;
			}
			else
			{
				//echo "User not logged";
				die("El nombre de usuario ". $User["username"] ." ya existe. Eljia otro <a href='user_create.php'>AQUI</a>");
			}
			
			
			
		//~ if ($_POST["txt_user"] == "benas" && $_POST["txt_pass"] == "benas")
		//~ {
			//~ $_SESSION["auth"] = true ;
			//~ $_SESSION["group"] = 2 ;
			//~ $_SESSION["user"] = $_POST["txt_user"];
			//~ $_SESSION["simba_userid"] = 5;
			//~ header("location: ../" . $_POST["appid"] ) ;
		//~ }
		//~ else
		//~ {
			//~ header("location: ../" . $_POST["appid"] . "?appid=" . $_POST["appid"] ) ;
		//~ }
		
		
		}
	//~ else
	//~ {
		//~ echo "No path..";
	//~ }
	
	
	//echo "Authenticate user";
	//echo "Redirect to: " . "../../". $_POST["appid"];




	// - - - ! Authenticate via google
	/*

	$clientid = "403333686677.apps.googleusercontent.com";
	$redirecturi = "http://www.atomic.mx/experiments/auth/google/index.php";


	$location = "https://accounts.google.com/o/oauth2/auth?"
		. "client_id=" . $clientid
		. "&" . "redirect_uri=" . $redirecturi
		. "&" . "scope=https://www.google.com/m8/feeds/"
		. "&" . "response_type=token";
		
	//$location = "http://google.com";
	 header( 'Location: ' . $location ) ;
	 
	 */
}



?>