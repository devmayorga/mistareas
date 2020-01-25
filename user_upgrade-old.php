<?php
//session_start();
include_once("user_upgradeModel.php");
if(!empty($_GET["uid"])){
	$Model = new user_upgradeModel($_GET["uid"]);
	?>
	Escriba su código de Activación
	<form action="user_upgrade.php" method="post">
		<input type="hidden" value="<?php echo $Model->User->Id ; ?>" name="uid" />
		<input type="text" name="upgradeCode" value="" />
		<input type="submit" value="Activar" name="upgrade-user" />
		<a href="home.php"><input type="button" value="Cancelar" name="cancelar" /></a>
	</form>
	<?php
}
else
{	

	if(isset($_POST["uid"]))
	{
		if(isset($_POST["upgradeCode"]) )
		{ 
			$Model = new user_upgradeModel($_POST["uid"]);
			$userUpgraded = $Model->upgradeUser($_POST["upgradeCode"]);
			
			if($userUpgraded === true)
			{
				?>
				CODIGO VÁLIDO!. 
				<br />
				LOS CAMBIOS SE PODRÁN VER LA PRÓXIMA VEZ QUE INICIE SESIÓN.
				<?php
				include_once("HtmlHelper.php");
				HtmlHelper::renderBackButton("SALIR", "utils/auth/logout.php");
				die();
				?>
				<a href="home.php">Inicio</a>
				<?php
			}
			else
			{
				?>
				CODIGO NO VÁLIDO!
				<br />
				<a href="user_upgrade.php?uid=<?php echo $_POST["uid"] ; ?>">Intentar de nuevo</a>
				<?php
			}
		}
	}
}
?>