<?php

class Dal
{	
	
	private $u ;
	private $p ;
	private $h ;
	private $db ;
	public $DalStatus ;

	public $con ;
	
	
	function __construct()
	{
		include_once("config.php");
		$config = new Config();
		$this->u = $config->User ;
		$this->p = $config->Password ;
		$this->h = $config->Host ;
		$this->db = $config->Database ;
		
		$this->Open();
		
		/* cambiar el conjunto de caracteres a utf8 */
		if (!mysqli_set_charset($this->con, "utf8")) {
			//printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($this->con));
			//exit();
			// THIS MUST BE A TRY
		} else {
			//printf("Conjunto de caracteres actual: %s\n", mysqli_character_set_name($this->con));
			
			//THIS MUST BE A CATCH
		}
	}
	
	function Open()
	{
		$this->con = mysqli_connect($this->h, $this->u, $this->p)or die ("Error de autenticacion... MySQL Dice: " . mysqli_error($con));
		$res = $this->con->select_db($this->db ) or die ("Error al seleccionar la BD... MySQL Dice: " . $this->con->error());
		$this->DalStatus = "OPEN"; 
	}
	
	function Close()
	{
		if($this->con->ping())
		{
			$this->con->close();
		}			
	}
	
	function getUser($p_id)
	{
		include_once("User.php");
		$user = new User();
		$method = "Dal.getUser";
		try
		{
			mysqli_begin_transaction($this->con);
			$sql = "select ifnull(username, '') as username
				, ifnull(type, 2) as type
				, id 
				, email
				, emailname
				, artistname
				from user where id = '". $p_id ."'" ;
			$res = mysqli_query($this->con,$sql) or die ("Error in method ". $method ."... MySQL dice: " . mysqli_error($this->con) );
			mysqli_commit($this->con);
			
			$row = mysqli_fetch_assoc($res);
			$user->Name = $row["username"];
			$user->Email = $row["email"];			
			$user->EmailName = $row["emailname"];			
			$user->ArtistName = $row["artistname"];			
			$user->Type = $row["type"];
			$user->Id = $row["id"];
			try
			{
				$this->con = mysqli_connect($this->h, $this->u, $this->p)or die ("Error de autenticacion... MySQL Dice: " . mysqli_error($con));
				$this->con->select_db($this->db ) or die ("Error al seleccionar la BD...");
				$user->Projects=$this->getUserProjects($user->Id);
				//$user->Features=$this->getUserFeatures($user->Id);
			}
			catch(Exception $e)
			{
				//header("location:utils/auth/logout.php");
			}
			if(strlen($user->Name)> 0 &&  $user->Type  > 0 )
			{
				return $user;
			}
		}
		catch (Exception $e) 
		{
			mysqli_rollback($this->con);
			die($e->getMessage());
			return null ;
		}
		return null ;
	}
	
	
	// JM 16.Mai.2019 
	function upgradeUser($userid, $upgradeCode)
	{
		$method = "Dal.upgradeUser";
		try
		{
			mysqli_begin_transaction($this->con);
			$sql = " CALL `sp_upgradeUser`('". $userid ."', '". $upgradeCode ."');";
			$res = mysqli_query($this->con, $sql);
			$row = mysqli_fetch_assoc($res);
			$upgradeStatus = $row["UpgradeSuccess"];
			mysqli_commit($this->con);
			return $upgradeStatus > 0  ;
		}
		catch (Exception $e) 
		{
			mysqli_rollback($this->con);
			return false ;
		}
	}
	
	function getTask($taskId)
	{
		$method = "Dal.getTask";
		include_once('Task.php');
		$sql = "select taskid
			, description
			, completed
			, projectid
			from task where taskid = " . $taskId; 
		$res = mysqli_query($this->con,$sql) or die ("Error in method ". $method ."... MySQL dice: " . mysqli_error($this->con) );
		$row = mysqli_fetch_assoc($res);
		$t_id = $row["taskid"];
		$t_name = $row["description"];
		$t_completed = $row["completed"] == 1 ? true : false ;
		$t_projectid = $row["projectid"];
		$newTask = new Task($t_id, $t_name, $t_completed, $t_projectid) ;
		return $newTask ;
	}
	
	function renameTask($task)
	{
		$method = "Dal.renameTask";
		try
		{
			mysqli_begin_transaction($this->con);
			$sql = "update task set description = '". $task->Name ."'  where taskid = " . $task->Id;
			mysqli_query($this->con, $sql);
			mysqli_commit($this->con);
			return true ;
		}
		catch (Exception $e) 
		{
			mysqli_rollback($this->con);
			return false ;
		}
	}
	
	function getUserIdByTask($taskid)
	{
		$method = "Dal.getUserIdByTask";
		try
		{		
			
			$sql = "select userid from project
			where id = (select projectid from task where taskid =  " . $taskid . ");";
			$res = mysqli_query($this->con,$sql) or die ("Error in method ". $method ."... MySQL dice: " . mysqli_error($this->con) );
			$row = mysqli_fetch_assoc($res);
			$userid = $row["userid"];
			//$sql2 = "select * from project where userid = " . $userid ; 
			//$Projects = $this->getUserProjects($userid);
			return $userid ;
		}
		catch (Exception $e) 
		{
			return null;
		}
	}
	
	
	function deleteTask($id)
	{
		$method = "Dal.deleteTask";
		try
		{
			mysqli_begin_transaction($this->con);
			$sql = "delete from task where taskid = " . $id; 			
			mysqli_query($this->con, $sql);			
			mysqli_commit($this->con);
			return true ;
		}
		catch (Exception $e) 
		{
			
			mysqli_rollback($this->con);
			return false ;
		}
	}
	
	
	// - - - ! 19-07-19
	function undoTask($id)
	{
		$method = "Dal.undoTask";
		try
		{
			mysqli_begin_transaction($this->con);
			$sql = "update task set completed = 0  where taskid = " . $id; 			
			mysqli_query($this->con, $sql);			
			mysqli_commit($this->con);
			return true ;
		}
		catch (Exception $e) 
		{
			
			mysqli_rollback($this->con);
			return false ;
		}
	}
	
	function assignTask($taskid, $userid)
	{
		$method = "Dal.assignTask";
		try
		{
			mysqli_begin_transaction($this->con);
			// $sql = "insert into r_task_user (taskid, userid) values ('". $taskid  ."', '". $userid ."')";
			$sql = " CALL `sp_asignarTarea`(". $taskid .", ". $userid .");";
			$res = mysqli_query($this->con, $sql);
			mysqli_commit($this->con);
			return true ;
		}
		catch (Exception $e) 
		{
			mysqli_rollback($this->con);
			return false ;
		}
	}
	
	function transferTask($taskid, $projectid)
	{
		$method = "Dal.assignTask";
		try
		{
			mysqli_begin_transaction($this->con);
			$sql = "update task
					set projectid = " . $projectid
					. " where taskid = " . $taskid ;
			
			$res = mysqli_query($this->con, $sql);
			
			mysqli_commit($this->con);
			return true ;
		}
		catch (Exception $e) 
		{
			mysqli_rollback($this->con);
			return false ;
		}
	}
	
	
	function insertProject($p_name, $User)
	{
		$method = "Dal.insertProject";
		include_once('Project.php');
		$sql = "insert into project (name, userid) values ('". $p_name ."', '". $User["id"] ."')"; 
		$res = mysqli_query($this->con,$sql) or die ("Error in method ". $method ."... MySQL dice: " . mysqli_error($this->con) );
		$id = mysqli_insert_id($this->con);
		$NewProject = new Project($id, $p_name);
		return $NewProject ;
	}
	
	function getProjectName($id)
	{
		$method = "Dal.getProjectName";
		$sql = "select name from project where id = " . $id; 
		$res = mysqli_query($this->con,$sql) or die ("Error in method ". $method ."... MySQL dice: " . mysqli_error($this->con) );
		$row = mysqli_fetch_assoc($res);
		
		return $row["name"];
	}
	
	function renameProject($project)
	{
		$method = "Dal.renameProject";
		try
		{
			mysqli_begin_transaction($this->con);
			$sql = "update project set name = '". $project->Name ."'  where id = " . $project->Id;
			mysqli_query($this->con, $sql);
			mysqli_commit($this->con);
			return true ;
		}
		catch (Exception $e) 
		{
			// An exception has been thrown
			// We must rollback the transaction
			mysqli_rollback($this->con);
			return false ;
		}
	}
	
	function deleteProject($id)
	{
		$method = "Dal.deleteProject";
		try
		{
			mysqli_begin_transaction($this->con);
			$sql1 = "delete from task where projectid = " . $id; 
			$sql2 = "delete from project where id = " . $id; 
			mysqli_query($this->con, $sql1);
			mysqli_query($this->con, $sql2);
			mysqli_commit($this->con);
			return true ;
		}
		catch (Exception $e) 
		{
			// An exception has been thrown
			// We must rollback the transaction
			mysqli_rollback($this->con);
			return false ;
		}
	}
	
	
	function getUserProjects($p_userid)
	{
		include_once('Project.php');
		$projects  = array();
		// JM: 16.May.2019. Agregar un PROYECTO "TAREAS ASIGNADAS" donde se depositaran las tareas asignadas.
		$virtualProjectId_AssignedTasks = -1 ;
		$projects[] = new Project($virtualProjectId_AssignedTasks, "tareas asignadas", $p_userid) ;
		$sql = "select id
		, name from project where userid = " . $p_userid;
		//  . ' or project.id in(select projectid from r_project_user where userid = '. $p_userid .')' ;
		// $res = mysqli_query($this->con,$sql) or die ("Error al leer los Clases de la BD... MySQL dice: " . mysqli_error($this->con));
		$res = mysqli_query($this->con,$sql) or die("Error al leer los Proyectos de la BD... MySQL dice: " . mysqli_error($this->con)) ;
		if (!$res)
		{
			echo "getUserProjects";
			throw new Exception('SesionExpiradaException');
		}
		while($row = mysqli_fetch_assoc($res))
		{
			$p = new Project($row["id"], $row["name"]);
			$projects[] = $p;
		}


		$sql = " select projectid as id 
				, p.name as name
				from r_project_user as rpu
				inner join project as p on  rpu.projectid = p.id
				where rpu.userid = " . $p_userid ;
		// $res = mysqli_query($this->con,$sql) or die ("Error al leer los Clases de la BD... MySQL dice: " . mysqli_error($this->con));
		$res = mysqli_query($this->con,$sql) ;
		if (!$res)
		{
			throw new Exception('SesionExpiradaException');
		}
		while($row = mysqli_fetch_assoc($res))
		{
			$p = new Project($row["id"], $row["name"]);
			$projects[] = $p;
		}

		return $projects ;
	}
	
	function getProjectTasks($p_projectid)
	{
		include_once('Task.php');
		$tasks  = array();
		$sql = "select taskid as id
				, description as name
				, completed
				from task where projectid = " . $p_projectid;
		$res = mysqli_query($this->con,$sql) or die ("Error al leer los Tasks de la BD... MySQL dice: " . mysqli_error($this->con));
		while($row = mysqli_fetch_assoc($res))
		{
			$t = new Task($row["id"], $row["name"], $row["completed"] == 1 ? true : false );
			$tasks[] = $t;
		}
		return $tasks ;
	}
	
	function getAssignedTasks($p_userid)
	{
		include_once('Task.php');
		$tasks  = array();
		$sql = "select taskid as id
				, description as name
				, completed
				from task where taskid in (select taskid from r_task_user where userid  = " . $p_userid . ") ; " ;
		$res = mysqli_query($this->con,$sql) or die ("Error al leer los Tasks de la BD... MySQL dice: " . mysqli_error($this->con));
		while($row = mysqli_fetch_assoc($res))
		{
			$t = new Task($row["id"], $row["name"], $row["completed"] == 1 ? true : false );
			$tasks[] = $t;
		}
		return $tasks ;
	}
	
	
	function getTaskDocuments($taskid, $type = 0 )
	{
		$Documents = null ;
		include_once("Document.php");
		$method = "Dal.getTaskDocuments";
		try
		{
			// mysqli_begin_transaction($this->con);
			$sql = " CALL `sp_getTaskDocuments`('". $taskid ."');";
			$res = mysqli_query($this->con, $sql) or die ("Error in method ". $method ."... MySQL dice: " . mysqli_error($this->con) );
			// mysqli_commit($this->con);
			$this->Close();
			
			while($row = mysqli_fetch_assoc($res))
			{
				$Document = new Document(
					 $row["Id"]
					, $row["Rowdate"]
					, $row["Type"]
					, $taskid
					, $row["r_task_user_id"]
					, $row["Url"]
					, $row["UploadedBy"]
					, $row["Comment"]
					);
				$this->Open();
				$Document->Nature = $this->getDocumentNature($Document->Id);
				$this->Close();
				$Documents[] = $Document;
			}
			return $Documents ; 
		}
		catch (Exception $e) 
		{
			// mysqli_rollback($this->con);
			return false ;
		}
		
	}

	// - - - ! 2020-06-26
	function getDocumentNatures()
	{
		$DocumentNatures = null ;
		include_once("DocumentNature.php");
		$method = "Dal.getDocumentNatures";
		try
		{
			mysqli_begin_transaction($this->con);
			$sql = " CALL `sp_getDocumentNatures`();";
			$res = mysqli_query($this->con, $sql) or die ("Error in method ". $method ."... MySQL dice: " . mysqli_error($this->con) );
			mysqli_commit($this->con);
			while($row = mysqli_fetch_assoc($res))
			{
				$DocumentNature = new DocumentNature(
					 $row["nature_id"]
					, $row["nature_name"]					
					);
				$DocumentNatures[] = $DocumentNature;
			}
			return $DocumentNatures ; 
		}
		catch (Exception $e) 
		{
			mysqli_rollback($this->con);
			return false ;
		}
		
	}
	// - - - ! 2020-06-26
	function getDocumentNature($p_document_id = 0)
	{		
		include_once("DocumentNature.php");
		$method = "Dal.getDocumentNature";
		try
		{
			mysqli_begin_transaction($this->con);
			$sql = " CALL `sp_getDocumentNature`('". $p_document_id ."');";
			$res = mysqli_query($this->con, $sql) or die ("Error in method ". $method ."... MySQL dice: " . mysqli_error($this->con) );
			mysqli_commit($this->con);
			$row = mysqli_fetch_assoc($res);
			
			$DocumentNature = new DocumentNature(
					$row["nature_id"]
				, $row["nature_name"]					
				);
			
			
			return $DocumentNature ; 
		}
		catch (Exception $e) 
		{
			mysqli_rollback($this->con);
			return false ;
		}
		
	}
	
	
	function getAssignedUsers($taskid)
	{
		$Users = null ;
		include_once("User.php");
		$method = "Dal.getAssignedUsers";
		try
		{
			mysqli_begin_transaction($this->con);
			$sql = " CALL `sp_getAssignedUsers`('". $taskid ."');";
			$res = mysqli_query($this->con, $sql);
			mysqli_commit($this->con);
			while($row = mysqli_fetch_assoc($res))
			{
				$User = new User(
					 $row["userid"]
					 , $row["username"]
					);
				$Users[] = $User ; 
				$User->ArtistName =  $row["artistname"] ;
				
			}
			return $Users ; 
		}
		catch (Exception $e) 
		{
			mysqli_rollback($this->con);
			return false ;
		}
		
	}
	
	function getUnassignedUsers($taskid)
	{
		$Users = null ;
		include_once("User.php");
		$method = "Dal.getUnassignedUsers";
		try
		{
			mysqli_begin_transaction($this->con);
			
			$sql = " CALL `sp_getUnassignedUsers`('". $taskid ."');";
			//die($sql);
			$res = mysqli_query($this->con,$sql) or die ("Error in method ". $method ."... MySQL dice: " . mysqli_error($this->con) );
			
			mysqli_commit($this->con);
			while($row = mysqli_fetch_assoc($res))
			{
				$User = new User(
					 $row["userid"]
					 , $row["username"]
					);
				$Users[] = $User ; 
				
			}
			return $Users ; 
		}
		catch (Exception $e) 
		{
			mysqli_rollback($this->con);
			return false ;
		}
		
	}
	
	
	// 25-09-2019
	// JM - Created for Ivan to test the Plattform and isolate his users from mines
	function getUserFeatures($userid)
	{
		// $this->con = mysqli_connect($this->h, $this->u, $this->p)or die ("Error de autenticacion... MySQL Dice: " . mysqli_error($this->con));
		// $this->con->select_db($this->db ) or die ("Error al seleccionar la BD...");
		$Features = null ;
		include_once("Feature.php");
		$method = "Dal.getUserFeatures";
		try
		{
			// mysqli_begin_transaction($this->con);
			
			$sql = " CALL `sp_getUserFeatures`('". $userid ."');";
			//die($sql);
			$res = mysqli_query($this->con,$sql) or die ("Error in method ". $method ."... MySQL dice: " . mysqli_error($this->con) );
			
			// mysqli_commit($this->con);
			while($row = mysqli_fetch_assoc($res))
			{
				$Feature = new Feature(
					 $row["featureid"]
					 , $row["name"]
					);
				$Features[] = $Feature ; 
				
			}
			return $Features ; 
		}
		catch (Exception $e) 
		{
			die($e->getMessage());
			// mysqli_rollback($this->con);
			$Features[] = new Feature();
		}
		// finally
		// {
			return $Features ;
		// }
		
	}
	
	
	// 25-09-2019
	// JM - Created for Ivan to test the Plattform and isolate his users from mines
	function getUserFriends($userid)
	{
		$Friends = null ;
		include_once("User.php");
		$method = "Dal.getUserFriends";
		try
		{
			mysqli_begin_transaction($this->con);
			
			$sql = " CALL `sp_getUserFriends`('". $userid ."');";
			//die($sql);
			$res = mysqli_query($this->con,$sql) or die ("Error in method ". $method ."... MySQL dice: " . mysqli_error($this->con) );
			
			mysqli_commit($this->con);
			while($row = mysqli_fetch_assoc($res))
			{
				$Friend = new User(
					 $row["friendid"]
					 , $row["artistname"]
					);
				$Friends[] = $Friend ; 
				
			}
			return $Friends ; 
		}
		catch (Exception $e) 
		{
			mysqli_rollback($this->con);
			$Friends[] = new User();
		}
		// finally
		// {
			return $Friends ;
		// }
		
	} // fin getUserFriends
	
	
	
	// 25-09-2019
	// JM - Created for Ivan to test the Plattform and isolate his users from mines
	function getUserNotFriends($userid)
	{
		$Friends = null ;
		include_once("User.php");
		$method = "Dal.getUserNotFriends";
		try
		{
			mysqli_begin_transaction($this->con);
			
			$sql = " CALL `sp_getUserNotFriends`('". $userid ."');";
			//die($sql);
			$res = mysqli_query($this->con,$sql) or die ("Error in method ". $method ."... MySQL dice: " . mysqli_error($this->con) );
			
			mysqli_commit($this->con);
			while($row = mysqli_fetch_assoc($res))
			{
				$Friend = new User(
					 $row["friendid"]
					 , $row["artistname"]
					);
				$Friends[] = $Friend ; 
				
			}
			return $Friends ; 
		}
		catch (Exception $e) 
		{
			mysqli_rollback($this->con);
			$Friends[] = new User();
		}
		finally
		{
			return $Friends ;
		}
		
	} // fin getUserNotFriends
	
	
	// 25-09-2019
	// JM - Created for Ivan to test the Plattform and isolate his users from mines
	function getUserSolicitudes($userid, $tipo)
	{
		$Friends = null ;
		include_once("User.php");
		$method = "Dal.getUserSolicitudes";
		try
		{
			mysqli_begin_transaction($this->con);
			if($tipo !== "Enviadas" && $tipo != "Recibidas")
			{
				throw new Exception("InvalidRequestException"); 
			}
			$sql = " CALL `sp_getUserSolicitudes". $tipo ."`('". $userid ."');";
			
			
			//die($sql);
			$res = mysqli_query($this->con,$sql) or die ("Error in method ". $method ."... MySQL dice: " . mysqli_error($this->con) );
			
			mysqli_commit($this->con);
			while($row = mysqli_fetch_assoc($res))
			{
				$Friend = new User(
					 $row["friendid"]
					 , $row["name"]
					);
				$Friends[] = $Friend ; 
				
			}
			return $Friends ; 
		}
		catch (Exception $e) 
		{
			mysqli_rollback($this->con);
			$Friends[] = new User();
		}
		// finally
		// {
			return $Friends ;
		// }
		
	} // fin getUserSolicitudes// 25-09-2019
	// JM - Created for Ivan to test the Plattform and isolate his users from mines
	function editarConexion($userid1, $userid2, $action)
	{
		$retval = true ; 
		
		$method = "Dal.editarConexion";
		
		
		switch($action)
		{
			case "aceptar":
				$sp = "sp_acceptConnection" ;
				$retval = "aceptado" ;
			break;
			case "desconectar":
				$sp = "sp_removeConnection" ;
				$retval = "desconectado" ;
			break;
			case "solicitar":
				$sp = "sp_requestConnection" ;
				$retval = "solicitado" ;
			break;
			default:
				throw new Exception ("InvalidRequestException") ;
		}
		
		
		try
		{
			mysqli_begin_transaction($this->con);
			
			$sql = " CALL `". $sp ."`('". $userid1 ."', '". $userid2 ."');";
			
			
			//die($sql);
			$res = mysqli_query($this->con,$sql) or die ("Error in method ". $method ."... MySQL dice: " . mysqli_error($this->con) );
			
			mysqli_commit($this->con);
			

		}
		catch (Exception $e) 
		{
			mysqli_rollback($this->con);
			$retval = false ; 
		}
		finally
		{
			
		}
		return $retval ;
		
	} // fin editarConexion
	
	function getConnectionStatus($userid1, $userid2)
	{
		$Status = null ;
		
		$method = "Dal.getConnectionStatus";
		try
		{
			mysqli_begin_transaction($this->con);
			
			$sql = " CALL `sp_getConnectionStatus`('". $userid1 ."', '". $userid2 ."');";
			//die($sql);
			$res = mysqli_query($this->con,$sql) or die ("Error in method ". $method ."... MySQL dice: " . mysqli_error($this->con) );
			
			mysqli_commit($this->con);
			while($row = mysqli_fetch_assoc($res))
			{
				
				$Status = $row["statusConnection"] ; 
				
			}
			
		}
		catch (Exception $e) 
		{
			mysqli_rollback($this->con);
			$Status = null ;
		}
		finally
		{
			return $Status ;
		}
	}
	
	function userHasAssignedTask($userid1, $p_taskid)
	{
		$Status = false ;
		
		$method = "Dal.getConnectionStatus";
		try
		{
			mysqli_begin_transaction($this->con);
			
			$sql = " select `fn_UserHasTask`('". $userid1 ."', '". $p_taskid ."') as UserHasTask;";
			//die($sql);
			$res = mysqli_query($this->con,$sql) or die ("Error in method ". $method ."... MySQL dice: " . mysqli_error($this->con) );
			
			mysqli_commit($this->con);
			$row = mysqli_fetch_assoc($res);
			
				
				if ( $row["UserHasTask"] > 0 )
				{
					$Status = true ;
				}
				
			
			
		}
		catch (Exception $e) 
		{
			mysqli_rollback($this->con);
			$Status = false ;
		}
		finally
		{
			return $Status ;
		}
	}
	
	
	
	// - - - > JM : Added thi function
	function unassignTask($taskid, $userid)
	{
		$method = "Dal.unassignTask";
		try
		{
			mysqli_begin_transaction($this->con);
			$sql = " CALL `sp_desasignarTarea`(". $taskid .", ". $userid .");" or die ("Error in method ". $method ."... MySQL dice: " . mysqli_error($this->con) );
			$res = mysqli_query($this->con, $sql);
			mysqli_commit($this->con);
			return true ;
		}
		catch (Exception $e) 
		{
			mysqli_rollback($this->con);
			return false ;
		}
	}
	
	
	function deleteDocument($id)
	{
		$method = "Dal.deleteProject";
		try
		{
			mysqli_begin_transaction($this->con);
			$sql1 = "delete from document where id = " . $id; 
			//$sql2 = "delete from project where id = " . $id; 
			mysqli_query($this->con, $sql1);
			//mysqli_query($this->con, $sql2);
			mysqli_commit($this->con);
			return true ;
		}
		catch (Exception $e) 
		{
			// An exception has been thrown
			// We must rollback the transaction
			mysqli_rollback($this->con);
			return false ;
		}
	}	


	function getUserLicencia($userid)
	{
		include_once("Licencia.php");
		$method = "Dal.getUserLicencia";
		try
		{
			
			$sql1 = "select licencia_id, startdate, enddate from licencia where user_id = " . $userid; 
			
			$res = mysqli_query($this->con, $sql1);

			if(mysqli_num_rows($res) > 0)
			{
				$row = mysqli_fetch_assoc($res);
				$licencia = new Licencia($row["licencia_id"]);
				$licencia->StartDate=$row["startdate"];
				$licencia->EndDate=$row["enddate"];
			}
			else
			{
				$licencia = new Licencia(0);
				$licencia->StartDate=date("Ymd");
				$licencia->EndDate=date("Ymd");

			}
			
			
		}
		catch (Exception $e) 
		{
			$licencia = null ;
		}
		echo "***" . $licencia->StartDate;

		return $licencia ;
	}

	function getLicencia($idLicencia)
	{
		include_once("Licencia.php");
		$method = "Dal.getUserLicencia";
		try
		{
			
			$sql1 = "select licencia_id, startdate, enddate from licencia where licencia_id = " . $idLicencia; 
			
			$res = mysqli_query($this->con, $sql1);
			$row = mysqli_fetch_assoc($res);
			$licencia = new Licencia($idLicencia);
			$licencia->StartDate=$row["startdate"];
			$licencia->EndDate=$row["enddate"];
			return $licencia ;
		}
		catch (Exception $e) 
		{
			return null ;
		}
	}

	function caducarLicencia($idLicencia)
	{
		include_once("Licencia.php");
		$method = "Dal.getUserLicencia";
		try
		{
			
			$sql1 = "select licencia_id, startdate, enddate from licencia where licencia_id = " . $idLicencia; 
			
			$res = mysqli_query($this->con, $sql1);
			$row = mysqli_fetch_assoc($res);
			$licencia = new Licencia($idLicencia);
			$licencia->StartDate=$row["startdate"];
			$licencia->EndDate=$row["enddate"];
			return $licencia ;
		}
		catch (Exception $e) 
		{
			return null ;
		}
	}


	function createUsuarioDePrueba($NuevoUser)
	{
		include_once("User.php");
		include_once("db/dal.php");
		$pass = "simple";

		$User = createUser(md5($NuevoUser->Email), md5($pass), $NuevoUser->Email, $NuevoUser->Email);
		if($User!=null)
		{
			$NuevoUser->Id = $User["id"] ;
			$NuevoUser->Name = $User["username"] ; 
			$NuevoUser->Email = $User["email"] ;
			$NuevoUser->Type = 2 ;
			$NuevoUser->ArtistName = $User["artistname"] ;
		}
		return $NuevoUser;
		
	}
	
	


	
	
	
	
	
}
?>
