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

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" >
    $(document).ready(function(){

      $("#buton-solicitarprueba").click(function(){
        $.ajax({
          async: false,
          type: "POST",
          url: "solicitar_prueba.php" ,
          data: "buton-solicitarprueba=1&txt-email=" + $("#txt-email").val(),
          success: function(msg){
            alert(msg);
          }
		    });

      });

    });


  </script>

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="#"><img src="img/logo.png"></a>
      <a class="btn btn-primary" href="login.php">Entrar</a>
    </div>
  </nav>

  <!-- Masthead -->
  <header class="masthead text-white text-center">
    <div class="overlay">
		
	</div>
    <div class="container">
      
	  <div class="row">
		
        <div class="col-xl-9 mx-auto">
		<br /><br />
		<br /><br />
		  <div class="row no-gutters">
			<div class="col-lg-6 order-lg-1 my-auto showcase-text">
			  <h2>Organiza</h2>
			  <!--
			  <p class="lead mb-0">Landing Page is just HTML and CSS with a splash of SCSS for users who demand some deeper customization options. Out of the box, just add your content and images, and your new landing page will be ready to go!</p>
			  -->
			</div>
			<div class="col-lg-6 order-lg-1 my-auto showcase-text">
			  <h2>Planifica</h2>
			  <!--
			  <p class="lead mb-0">Landing Page is just HTML and CSS with a splash of SCSS for users who demand some deeper customization options. Out of the box, just add your content and images, and your new landing page will be ready to go!</p>
			  -->
			</div>
		  </div>
		  <div class="row no-gutters">
			<div class="col-lg-6 order-lg-1 my-auto showcase-text">
			  <h2>Comparte</h2>
			  <!--
			  <p class="lead mb-0">Landing Page is just HTML and CSS with a splash of SCSS for users who demand some deeper customization options. Out of the box, just add your content and images, and your new landing page will be ready to go!</p>
			  -->
			</div>
			<div class="col-lg-6 order-lg-1 my-auto showcase-text">
			  <h2>Enseña</h2>
			  <!--
			  <p class="lead mb-0">Landing Page is just HTML and CSS with a splash of SCSS for users who demand some deeper customization options. Out of the box, just add your content and images, and your new landing page will be ready to go!</p>
			  -->
			</div>
		  </div>
		  
        </div>
		
       
		
		
      </div>
    </div>
  </header>

  <!-- Icons Grid -->
  <section class="features-icons bg-light text-center">
    <a name="icons" />
	<div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
              <i class="icon-check m-auto text-primary"></i>
            </div>
            <h3>Proyectos</h3>
            <p class="lead mb-0">Organiza, asigna y controla las tareas de tus proyectos y cumple tus objetivos a tiempo.</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
			  <i class="icon-screen-desktop m-auto text-primary"></i>  
            </div>
            <h3>Enseñanza</h3>
            <p class="lead mb-0">Planifica tus clases, envíalas a tus alumnos y recibe sus trabajos de la manera mas simple que existe.</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="features-icons-item mx-auto mb-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
              <i class="icon-layers m-auto text-primary"></i>
            </div>
            <h3>Colaboración</h3>
            <p class="lead mb-0">Comparte documentos con tus amigos en cualquier parte del mundo; en cualquier momento.</p>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Image Showcases -->
<!---->
  <section class="showcase">
    <div class="container-fluid p-0">
      <div class="row no-gutters">

        <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('img/project.jpeg');"></div>
        <div class="col-lg-6 order-lg-1 my-auto showcase-text">
          <h2>Proyectos y cursos</h2>
          <p class="lead mb-0">
			Esta aplicación sirve para profesores, managers, secretarias, estudiantes, hogar... En fin para cualquier profesión y para cuaquier persona que 
			quiera organizar un Objetivo a cumplir...
		  </p>
        </div>
      </div>
      <div class="row no-gutters">
        <div class="col-lg-6 text-white showcase-img" style="background-image: url('img/task.png');"></div>
        <div class="col-lg-6 my-auto showcase-text">
          <h2>Tareas</h2>
          <p class="lead mb-0">
			Organiza tu proyecto en pequeñas tareas a completar para que sea fácil alcanzar tus objetivos. Organiza tus cursos en temas para obtener mejores rendimientos.
		  </p>
        </div>
      </div>
      <div class="row no-gutters">
        <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('img/share.png');"></div>
        <div class="col-lg-6 order-lg-1 my-auto showcase-text">
          <h2>Documenta y comparte</h2>
          <p class="lead mb-0">
			Guarda en la Nube los documentos de un proyecto, o los recursos para una clase y compártelos con tus contactos.
		  </p>
        </div>
      </div>
    </div>
  </section>
<!---->
  <!-- Testimonials 
  <section class="testimonials text-center bg-light">
    <div class="container">
      <h2 class="mb-5">Proyectos recientes</h2>
      <div class="row">
        <div class="col-lg-4">
          <div class="testimonial-item mx-auto mb-5 mb-lg-0">
            <img class="img-fluid rounded-circle mb-3" src="img/testimonials-1.jpg" alt="">
            <h5>Ivan G.</h5>
            <p class="font-weight-light mb-0">"Organizar mis Proyectos nunca fue tan fácil!"</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="testimonial-item mx-auto mb-5 mb-lg-0">
            <img class="img-fluid rounded-circle mb-3" src="img/testimonials-2.jpg" alt="">
            <h5>Clara F.</h5>
            <p class="font-weight-light mb-0">"Es una gran herramienta para poder aprender desde casa"</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="testimonial-item mx-auto mb-5 mb-lg-0">
            <img class="img-fluid rounded-circle mb-3" src="img/testimonials-3.jpg" alt="">
            <h5>Sarah W.</h5>
            <p class="font-weight-light mb-0">"Thanks so much for making these free resources available to us!"</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  -->

  <!-- Call to Action -->
  <section class="call-to-action text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h2 class="mb-4">¡Crea una cuenta con tu email o whatsapp!</h2>
        </div>
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
          <form>
            <div class="form-row">
              <div class="col-12 col-md-9 mb-2 mb-md-0">
                <input type="email" class="form-control form-control-lg" placeholder="Escribe tu email..." name="txt-email" id="txt-email">
              </div>
              <div class="col-12 col-md-3">
                <button type="button" class="btn btn-block btn-lg btn-primary" id="buton-solicitarprueba" name="buton-solicitarprueba">¡Crear cuenta YA!</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
          <ul class="list-inline mb-2">
            <li class="list-inline-item">
              <a href="#">Conocer mas</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Contacto</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Términos de uso</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Política de uso de datos</a>
            </li>
          </ul>
          <p class="text-muted small mb-4 mb-lg-0">&copy; mistareas.com.mx 2020. Todos los derechos reservados.</p>
        </div>
        <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
          
		  <!--
		  <ul class="list-inline mb-0">
            <li class="list-inline-item mr-3">
              <a href="#">
                <i class="fab fa-facebook fa-2x fa-fw"></i>
              </a>
            </li>
            <li class="list-inline-item mr-3">
              <a href="#">
                <i class="fab fa-twitter-square fa-2x fa-fw"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-instagram fa-2x fa-fw"></i>
              </a>
            </li>
          </ul>
		  -->
		  
        </div>
      </div>
    </div>
  </footer>

  

</body>

</html>
