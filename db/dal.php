<?php
//#Region Authentication

function authenticateUser($strUsername, $strPassword)
{
	include("connect.php");

	$validuser = false;
			
	$sql = "select ifnull(username, '') as username
		, ifnull(password, '') as password
		, ifnull(type, 2) as type
		, id 
		, email
		, emailname
		, artistname
		from user where username = '". md5($strUsername) ."' 
		and password = '". md5($strPassword). "' " ;
	//die($sql);
	$res = mysqli_query($con,$sql) or die ("Error al autenticar usuario... MySQL dice: " . mysqli_error($con) );
	$row = mysqli_fetch_assoc($res);
	$User["username"] = $row["username"];
	$User["email"] = $row["email"];
	$User["emailname"] = $row["emailname"];
	$User["password"] = $row["password"];
	$User["type"] = $row["type"];
	$User["id"] = $row["id"];
	$User["artistname"] = $row["artistname"];
	if(strlen($User["username"])> 0 && strlen($User["password"] ) > 0)
	{
		$validuser = true;			
	}
	$User["validuser"] = $validuser;
	if($User["validuser"])
	{			
		return $User;
	}
	return null;
}

//#End Region




// Returns a Key Value Pair List
function getCatalogWithUser($entity, $user)
{
	$condition = false ;
	$conditionString = "" ;
	include("connect.php");
	
	
	
	$sql = "select id, name from " . $entity  . " where userid = " . $user["id"];
	
	
	
	if($condition)
	{
		$sql .= " " . $conditionString ;
	}
	
	//echo $sql ;
	$res = mysqli_query($con,$sql) or die ("Error al obtener el catalogo *". $entity ."*... MySQL dice: " . mysql_error());
	return $res ;
	
}

function getHoraServidor()
	{
		include("connect.php");
		$method = "dal.getHoraServidor";
		$SqlHoraServidor = "select CURRENT_TIMESTAMP as horaServidor"	;
		try
		{
			$ResultadoHoraServidor = mysqli_query($con, $SqlHoraServidor) or die ("Error al obtener la HOra del servidor");
	

			$row = mysqli_fetch_assoc($ResultadoHoraServidor);
			$HoraServidor=$row["horaServidor"];
			
			return $HoraServidor ;
		}
		catch (Exception $e) 
		{
			return null ;
		}
		
	}

function createUser($strUsername, $strPassword, $strArtistName, $strEmail = "testing@josemayorga.com")
{
	include("connect.php");
	
	/*Verificar que NO exista el usuario*/
	$validuser = false;
			
	$sql = "select ifnull(username, '') as username
		from user where username = '". $strUsername ."' 
		" ;
	$res = mysqli_query($con,$sql) or die ("Error al autenticar usuario... MySQL dice: " . mysqli_error($con) );
	$row = mysqli_fetch_assoc($res);
	if($row != null)
	{
		$User["username"] = $row["username"];
	}
	else
	{
		$User["username"] = "";
	}
	if(strlen($User["username"])> 0 )
	{
		$validuser = true;			
	}
	$User["validuser"] = $validuser;
	
	if($User["validuser"])
	{			
		return null ; 
	}
	else
	{
		
		/* Se inserta el Usuario y despues se devuelve*/
		
		$sql = "insert into user (username, password, artistname, email) values ('". $strUsername ."', '". $strPassword ."', '". $strArtistName ."')" ;
		if($strEmail != "testing@josemayorga.com)")
		{
			$sql = "insert into user (username, password, artistname, email, emailname, type) values ('". $strUsername ."', '". $strPassword ."', '". $strArtistName ."', '" . $strEmail ."','". $strArtistName ."', 2)" ;	
		}
		$res = mysqli_query($con,$sql) or die ("Error en dal.createUser(str,str)... MySQL dice: " . mysqli_error($con) . "<a href='index.php'>inicio</a>");
	
		
		
		
		// Construir el nuevo User a partir del recien creado
		$validuser = false;
				
		$sql = "select ifnull(username, '') as username
			, ifnull(artistname, '') as artistname
			, ifnull(password, '') as password
			, ifnull(type, 2) as type
			, id 
			, email
			, emailname
			from user where username = '". $strUsername ."' 
			and password = '". $strPassword. "' " ;
		$res = mysqli_query($con,$sql) or die ("Error al autenticar usuario... MySQL dice: " . mysqli_error($con) );
		$row = mysqli_fetch_assoc($res);
		$User["username"] = $row["username"];
		$User["email"] = $row["email"];
		$User["emailname"] = $row["emailname"];
		$User["password"] = $row["password"];
		$User["type"] = $row["type"];
		$User["id"] = $row["id"];
		$User["artistname"] = $row["artistname"];
		if(strlen($User["username"])> 0 && strlen($User["password"] ) > 0)
		{
			$validuser = true;			
		}
		$User["validuser"] = $validuser;
		if($User["validuser"])
		{
			$horaServidor = getHoraServidor();
			$sql2= "insert into licencia ( upgradeCode, user_id, enddate, author) values ('". $strUsername ."', '". $User["id"] ."',date_add('". $horaServidor ."', INTERVAL 30 DAY) ,0)" ;		
			$res2 = mysqli_query($con,$sql2) or die ("Error al insertar la licencia usuario... MySQL dice: " . mysqli_error($con) );
			return $User;
		}
		return null;
	
	
	
	
	}
	

	
}

?>