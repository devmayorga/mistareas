<?php
$url = "../logos/mistareas.png" ;
if(isset($callingFromLevelUp))
{
	if($callingFromLevelUp)
	{
		$url = "utils/logos/mistareas.png" ;
	}
	
}



if(!isset($callingFromLogin))
{
	$callingFromLogin = false ; 
}


?>
<div class="row" >
	<div class="col" style="/*background-color: #7dcbe1 ; */ /*border: 1px solid black ;*/ ">&nbsp;</div>
	<div class="col" style="/*background-color: #f5ddea ; */ " >&nbsp;</div>
</div>
<div class="row"  >
	<div class="col" style="/*background-color: #7dcbe1 ; */ ">&nbsp;</div>
	<div class="col" style="text-alignment: center ; /* border: 1px solid black ; */ " >
		<center>
		<?php
		
		if(!$callingFromLevelUp)
		{
			?>
			<img src="<?php echo $url ; ?>">
			<?php
		}
		?>
		<!-- <img id="img-project-menu" class="img-menuproject"  src="img/menuproject-color.png" /> -->
		<?php
		if(!$callingFromLogin)
		{
			?>
			<a href="home.php"><img src="<?php echo $url ; ?>"></a>
			<a href="todolist.php"><img  src="img/help-color.png" /></a>
			<?php
		}
		else
		{
				
				
		}
		?>
		
		</center>
	</div>
	<div class="col" style="/*background-color: #f5ddea ; */" ></div>
</div>
<div class="row">
	<div class="col" style="/*background-color: #7dcbe1 ; */">&nbsp;</div>
	<div class="col" style="/*background-color: #f5ddea ; */" >&nbsp;</div>
</div>	  