<title>Mis Tareas</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

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
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    
<style>
#d-bigcontainer 
{
	display: flex;
	justify-content: center;
	border:1px solid red ; 
	width:1060px; 
	padding-top:40px;
	/*text-alignment:center;*/
}
#d-legend
{
	position:absolute; top:320; 
	/*font-family: 'Tangerine', serif;*/
	font-size: 48px;
	width: 100%;
	border: 1px solid red ; 
}
.d-legend-left
{
	
	/*font-family: 'Tangerine', serif;*/
	
	color: white ;

}
.d-legend-right
{
	
	/*font-family: 'Tangerine', serif;*/
	
	color: blue ; 
}
.d-legend-table
{
	
	border : 1px solid red ; 
}
#d-header
{ 
	background-image: url('<?php echo $backgroundPath  ; ?>');
	background-repeat:no-repeat;
	display: flex;
	justify-content: center;
	border:1px solid green ; 
	width:1060px; 
	height: 700px ;
}
#d-logo
{
	margin-top: 100px;
	height: 128px;
}
</style>
<div id="d-header">
	<img id="d-logo" src="<?php echo $logoPath ; ?>" />
</div>
<div id="d-legend">
	<?php
	Partial("d-legend", null,null);
	?>
</div>
<div id="d-bigcontainer">
	<?php
	Partial($partialToRender, null,null);
	?>
</div>


