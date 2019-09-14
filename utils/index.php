<?php
session_start();

$appid = "mistareas.com.mx";


header ("Location: auth/login4.php?appid=" . $appid);

?>
