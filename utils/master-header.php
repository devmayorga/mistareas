<?php
$partialsPath = "Partials.php";
$backgroundPath = "img/fondo-01.png";
$logoPath = "img/logo.png";
if(isset($callingFromLogin) )
{
	if($callingFromLogin)
	{
		$partialsPath = "../../" . $partialsPath ;
		$backgroundPath = "../../" . $backgroundPath;
		$logoPath = "../../" . $logoPath ; 
		$callingFromLogin = true ;
	}
	// else
	// {
		// $partialsPath = "Partials.php";
		// $backgroundPath = "img/fondo-01.png";
		// $logoPath = "img/logo.png";
	// }
}
include_once($partialsPath);


// $partialToRender debe ser inicializada en la pagina desde donde se invoca este master-header
if(!isset($partialToRender))
{
	echo "ERROR";
}

?>






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
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>mistareas.com.mx</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="css/landing-page.min.css" rel="stylesheet">

</head>

<body>

 
  <!-- Masthead -->
  <header class="masthead text-white text-center">
    <div class="overlay">
		
	</div>
    <div class="container">
      
	  <div class="row">
			
			<div id="d-bigcontainer">
				<?php
				Partial($partialToRender, null,null);
				?>
			</div>
      
      </div>
    </div>
  </header>

 
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>








































