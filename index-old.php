<?php
session_start();

$appid = "mistareas.com.mx";

// - - - > Call function to verify if user is authenticated
if(isset($_SESSION["User"]))
{
	if ( $_SESSION["User"]["validuser"]  )
	{
		//echo "Authentication found!... Redirect to todolist.php";
		header("Location: home.php" );
	}
}

else
{
	header ("Location: utils/auth/login4.php?appid=" . $appid);
}
?>
