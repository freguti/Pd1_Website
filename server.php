<?php
ob_start();
$errors = array();
session_start();

if(isset($_POST['register_user'])){
	$db = dbConnection();
	//check for sql-injection
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password =  $_POST['password'];
	$confirm = $_POST['password2'];
	if(empty($email)){ array_push($errors, "Email is required"); }
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ array_push($errors, "Email is not valid");	} //gli errori verranno gestiti dalla pagina che li genera
	if(empty($password) || empty($confirm)){ array_push($errors, "Password required"); } //array push insert in tail of array
	if(strcmp($confirm,$password) != 0){ array_push($errors, "The two password are not equal"); }
	$special_chars = preg_replace('/[A-Za-z0-9]/', '', $password);
	$numbers = preg_replace('/[^0-9]/', '', $password);
	if(strlen( $password) < 3 || strlen($special_chars) < 2 || strlen($numbers) < 1) { array_push($errors, "Password invalid"); }
	
	if(sizeof($errors) == 0)
	{
		try{
			$password = md5($password);
			mysqli_autocommit($db, false);
			mysqli_query($db, "SELECT * FROM users FOR UPDATE OF users");
			
			$check_user_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
			$user = mysqli_fetch_assoc(mysqli_query($db, $check_user_query));
			if($user){  //se esiste già
				array_push($errors, "email already registered");
				mysqli_autocommit($db, true);
				mysqli_close($db);
				return false;
			}
			$query = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
			if(!mysqli_query($db, $query)){
				throw new Exception("Error Processing Request", 1);
			}
			if(!mysqli_commit($db)){
				throw Exception("Commit failed");
			}
			$_SESSION['email'] = $email;
			$_SESSION['time'] = time();
			setcookie("user", $email, time() + 120, "/");
			$_SESSION['success'] = "You are now logged in";
			mysqli_autocommit($db, true);
			mysqli_close($db);
			header('location: home.php'); //redirect a index.php
		}
		catch (Exception $e)
		{
			mysqli_rollback($db);
			echo "Rollback ".$e->getMessage();
			mysqli_autocommit($db, true);
			mysqli_close($db);
			return false;
		}
	}
	mysqli_close($db);
}


if(isset($_POST['login_btn'])){
	$db = dbConnection();
	//check for sql-injection
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password =  $_POST['password'];
	if(empty($email)){ array_push($errors, "Email is required"); }
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ array_push($errors, "Email is not valid");	} //gli errori verranno gestiti dalla pagina che li genera
	if(empty($password)){ array_push($errors, "Password required"); } //array push insert in tail of array
	
	if(sizeof($errors) == 0)
	{
		$password = md5($password);
		mysqli_query($db, "SELECT * FROM users FOR UPDATE OF users"); //non so nemmeno se c'è bisogno di loccare in sola lettura, nessuno mi cambia i record
		$select_user = "SELECT * FROM users WHERE email='$email' AND password='$password' ";

		$results = mysqli_query($db, $select_user);
		if(mysqli_num_rows($results) == 1){ 
			$_SESSION['email'] = $email;
			$_SESSION['time'] = time();
			setcookie("user", $email, time() + 120, "/");
			$_SESSION['success'] = "You are now logged in";
			mysqli_close($db);
			header('location: home.php'); //redirect a index.php
		}
		else
		{
			array_push($errors, "Wrong email or Password");
		}
	}
	mysqli_close($db);
}

if(isset($_GET['getcolors'])){
	$db = dbConnection();
	$query = "SELECT * FROM booking";
	$result = mysqli_query($db, $query);
	$patient = array();

		while($record = mysqli_fetch_array($result))
		{
			$patient[$record['DataOra']] = [$record['Utente'],$record['DataOraPren']];
		}

	mysqli_close($db);
	echo json_encode($patient);
}

if(isset($_POST['postfunctions'])){
	if($_POST['postfunctions'] == 'postclick')
	{
		if(!checkSession()){echo '-1'; exit();}
		$db = dbConnection();
		
		mysqli_close($db);
		echo 'prenotazione effettuata con successo';
		echo 'uno o più slot non sono disponibili';
		
		exit();
	}
}
/*
non va con l'ajax. forse a volte serve per forza cosi

if(isset($_POST['postfunctions'])){
	$function = $_POST['postfunctions'];
	$string = "";
	switch($function){
		case 'user_register':
			mysqli_query($db, 'INSERT INTO users VALUES ("register","user")');		
		//header('location: index.php');
		break;
		default:
	}	
}
*/
function dbConnection()
{
    $db = mysqli_connect("localhost", "root" , "" ,"sitopd1");
	if(mysqli_connect_errno()){
		die("Internal server error" . mysqli_connect_errno());
	}
	if(!mysqli_select_db($db, "sitopd1")){
		die("Selection of DB error");
    }
    
    return $db;
}


function checkHttps(){ //da mettere nell'intestazione php di ogni pagina
	if (!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] == 'off') {
        header("location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		exit();
	}
}

function checkSession(){
	$start_t = time();
	$delta_t = 0;
	$new = false;
	if (isset($_SESSION['time'])){
	  $curr_t = $_SESSION['time'];
	  $delta_t = ($start_t  -$curr_t); //periodo passato senza aggiornare una pagina
	} else {
	  $new=true;
	}
	if ($new || ($delta_t > 120)) { //distruggo la sessione
		$_SESSION=array();
	  if (ini_get("session.use_cookies")) {
		  $params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 3600*24, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
	  }
	  session_destroy();
	  return false;
	} else {
	  $_SESSION['time']=time(); //aggiorno la sessione per altri 120 secondi
	}
	return true;
  }
  function checkCookie(){
	  setcookie("test_cookie", "test", time() + 3600, '/');
	  if(count($_COOKIE) == 0){
		  echo "Enable cookies to navigate this site";
		  exit();
	  }
  }

?>