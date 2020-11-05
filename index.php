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
            <h3>Clases</h3>
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
          <h2>Desde cualquier parte del mundo sin que tengas que instalar la App</h2>
          <p class="lead mb-0">
			mistareas.com.mx es accesible desde cualquier parte del mundo y prácticamente cualquier dispositivo, incluyendo T.V., smart-device... y sin tener que instalar nada...
      <br />
      Tiene soporte para Escuelas y maestros independientes como creadores del contenido, y la audiencia podrían ser aprendices autodidactas o alumnos de alguna escuela registrada en la plataforma www.mistareas.com.mx
		  </p>
        </div>
      </div>
      <div class="row no-gutters">
        <div class="col-lg-6 text-white showcase-img" style="background-image: url('img/task.png');"></div>
        <div class="col-lg-6 my-auto showcase-text">
          <h2>Documenta y comparte Clases, Cursos, Tareas, ...</h2>
          <p class="lead mb-0">
			Organiza tus Cursos en Clases para compartir con Grupos de Usuarios . Divide tus Clases en Tareas para obtener más niveles en la personalización de la enseñanza. Por ejemplo: A un alumno de cuarto grado le resulta sencillo aprender y comprende todo acerca de cierta asignatura mientras sus compañeros se tienen que esforzar más. Pues una manera de mantener de ese alumno motivado en su aprendizaje es que acceda a lecciones de quinto grado en esa materia en particular (aunque el alumno siga perteniciendo a cuarto grado). Aquí entra mistareas.com.mx como aliado en la enseñanza, pruébalo!
		  </p>
        </div>
      </div>
      <div class="row no-gutters">
        <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('img/share.png');"></div>
        <div class="col-lg-6 order-lg-1 my-auto showcase-text">
          <h2>Enseñanza 3.0 ... La Enseñanza sin límites... </h2>
          <p class="lead mb-0">
          Guarda en la Nube (o sea no en tu móvil o tu ordenador sino directo en la plataforma en internet) los Documentos de una Clase, o los Ejercicios recomendados para reforzar un tema y compártelos con tus contactos de manera individual o grupal. No importa si eres boomer o mil-lenial, si te interesean la auto-enseñanza-aprendizaje y la divulgación del conocimiento, www.mistareas.com.mx es tu herramienta. ¡Úsala!.
          </p>
        </div>
      </div>
    </div>
  </section>
<!---->
  <!-- Testimonials 
  <section class="testimonials text-center bg-light">
    <div class="container">
      <h2 class="mb-5">Clases recientes</h2>
      <div class="row">
        <div class="col-lg-4">
          <div class="testimonial-item mx-auto mb-5 mb-lg-0">
            <img class="img-fluid rounded-circle mb-3" src="img/testimonials-1.jpg" alt="">
            <h5>Ivan G.</h5>
            <p class="font-weight-light mb-0">"Organizar mis Clases nunca fue tan fácil!"</p>
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
