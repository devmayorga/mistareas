<?php
function validarEmail($email)
{
    return true;
}


if(isset($_POST["buton-solicitarprueba"])){
    if(isset($_POST["txt-email"])){
        include_once("Dal.php");
        include_once("User.php");
        $Dal = new Dal();
        $UsuarioDePrueba = new User();
        $UsuarioDePrueba->Email = $_POST["txt-email"];
        $UsuarioDePrueba->ArtistName = $_POST["txt-email"];
        $UsuarioDePrueba->ArtistName = $_POST["txt-email"];
        $EmailValido = validarEmail($UsuarioDePrueba->Email);
        if($EmailValido)
        {
            $pass="simple";
            $UsuarioDePrueba = $Dal->createUsuarioDePrueba($UsuarioDePrueba);
            if($UsuarioDePrueba->Name=="") die("Intente otro usuario");
            echo "Tome nota de su información para Entrar al Sistema: \n\nUsuario: '" . $UsuarioDePrueba->Email . "'"
                    . ". \nPassword: '" . $UsuarioDePrueba->TempPass . "'" ;
            ;
        }
    }
}
else
{
    echo "HOLA";
}



?>