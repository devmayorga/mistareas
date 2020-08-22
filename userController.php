<?php
/**
* @return bool
*/

class userController
{
    function verificarSesion()
    {
        if(! isset($_SESSION["User"]))
        {
        ?>
        SESION EXPIRADA O CERRADA EN OTRA INSTANCIA DE LA PLATAFORMA. <a href="utils/auth/logout.php">Inicio</a>
        <?php
        die();
        }
    }
}



?>
