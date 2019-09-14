<?php
session_start();

include_once("db/dal.php");
$Project["name"] = $_POST["name"] ;

$id = insertProject($Project, $_SESSION["User"]);

?>
<a href="todolist.php?p=<?php echo $id ; ?>"><?php echo $Project["name"] ; ?></a>