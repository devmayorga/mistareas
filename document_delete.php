<?php
include_once("Partials.php");
include_once("document_deleteModel.php");
include_once("todolistModel.php");
session_start();

if(!isset($_SESSION["User"]))
{
	$userid = 0 ;
}
else
{
	$userid = $_SESSION["User"]["id"];
}



$Model2 = new todolistModel($userid);



$renderFirstTime = false ;

if(!empty($_GET["p"]))
{
	$Model = new document_deleteModel($_GET["p"]);
    $Model->Document->Url = $_GET["document_name"] ;
    $Model->ProjectId = $_GET["project_id"] ;
	$renderFirstTime = true ;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>

    <?php
    Partial("partial-metas", null, "");
    ?>

</head>

<body>
    <?php
    Partial("partial-navigator", $Model2->User, "");
    ?>

    <!-- Page Content -->
    <div class="container">
        <br />
        <br /><br /><br /><br /><br /><br /><br />






        <?php

        if($renderFirstTime){

        ?>
        <p class="mt-5">
            <h2>
                Borrando Documento: <small>" <?php echo $Model->Document->Url ; ?> "</small>.
                <h2>
                    <br>
                    ¿Desea continuar?
                    <form action="document_delete.php" method="post">
                        <input type="hidden" value="<?php echo $Model->Document->Id ; ?>" name="documentid" />
                        <input type="hidden" value="<?php echo $Model->ProjectId ; ?>" name="projectid" />
                        <input class="btn btn-danger" type="submit" value="Continuar" name="delete-document" />
                        <a class="btn btn-secondary" href="todolist.php?p=<?php echo $Model->ProjectId ; ?>">Cancelar</a>
                    </form>
        </p>

        <?php
        }
        else
        {
        if(isset($_POST["delete-document"]))
        {
        if(isset($_POST["documentid"]))
        {
        $Model = new document_deleteModel($_POST["documentid"]);
        $Model->ProjectId = $_POST["projectid"];
        $documentDeleted = $Model->deleteDocument();
        if($documentDeleted)
        {
        ?>
        DOCUMENTO <?php echo $Model->Document->Url ; ?> BORRADO !
        <br>
        <?php
        }
        else
        {
        ?>
        DOCUMENTO <?php echo $Model->Document->Url ; ?> NO BORRADO !
        <?php
        }
        ?>
        <a class="btn btn-primary" href="todolist.php?p=<?php echo $Model->ProjectId;?>">Volver</a>
        <br>
        <br>
        <?php
        }
        }
        }
        ?>
    </div>
    <!-- /.container -->
    <?php
    Partial("partial-footer", null, "");
    ?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
