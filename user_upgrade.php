<?php
session_start();
include_once("user_upgradeModel.php");
if(!empty($_GET["uid"])){
	$Model = new user_upgradeModel($_GET["uid"]);
	?>
	Escriba su código de Actualización
	<form action="user_upgrade.php" method="post">
		<input type="hidden" value="<?php echo $Model->User->Id ; ?>" name="uid" />
		<input type="text" name="upgradeCode" value="" />
		<input type="submit" value="Actualizar" name="upgrade-user" />
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
			if($userUpgraded)
			{
				$redirectLocation = "Location:home.php";
				header($redirectLocation);
			}
			else
			{
				?>
				CUENTA NO ACTUALIZADA !
				<br />
				<a href="index.php">Inicio</a>
				<?php
			}
		}
	}
}
?>