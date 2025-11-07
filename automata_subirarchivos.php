<?php
include_once("Partials.php");
switch($_POST['from'])
{
    case '1':
        
        switch($_POST["natureId"])
        {
            case "0":
            case "1":
            case "2":
            case "3":
            case "6":
            case "7":
            case "12":
            case "13":
            case "14":
            case "15":
                $accion = "examinar";
                $modelEstado2 = array('uid' =>$_POST["uid"] , 'type'=>$_POST["type"], 'taskid'=>$_POST["taskid"], 'nature'=>$_POST["natureId"]);
                die(renderPartialEstado2AutomataSubirArchivos($accion, $modelEstado2 ));
            break;
            default:
                $accion ="escribir";
        }
    break;
}

?>