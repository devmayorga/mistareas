<?php
session_start();
$appid = "mistareas.com.mx";
include_once("Partials.php");
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
		
      
		
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
			
          <form action="utils/auth/login3.php" method="post">
			
			<br /><br /><br />
            
			<div class="form-row text-center">
				<h2>
			Entrar en <?php echo $appid ; ?>
			</h2>
			  <div class="col-12 col-md-9 mb-2 mb-md-0">
                <input name="txt_user" type="text" class="form-control form-control-lg" placeholder="Usuario.." />
                <input name="txt_pass" type="password" class="form-control form-control-lg" placeholder="Password..." />
				<input type="submit" class="btn btn-block btn-lg btn-primary" value="Entrar" name="send" />
				<input type="hidden"  value="<?php echo $appid ; ?>" name="appid" />
				<br />
				<a href="index.php"  class="btn btn-block btn-lg btn-primary">Volver</a>
              </div>
			  
			  
              
            </div>
          </form>
        </div>
		
		
      </div>
    </div>
  </header>

		<?php
			
		Partial("partial-footer", null, "");

		?>  
  
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
