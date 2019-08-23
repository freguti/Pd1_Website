<?php
ob_start();
$errors = array();
session_start();

//mysqli_query($db, 'INSERT INTO users VALUES ("simone","ciao")'); FUNZIONA

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
			// da fare l'inserimento (lock tabella, controllo presenza, inserisco, unlock )
			$password = md5($password);
			mysqli_autocommit($db, false);
			mysqli_query($db, "SELECT * FROM users FOR UPDATE OF users");
			
			$check_user_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
			$user = mysqli_fetch_assoc(mysqli_query($db, $check_user_query));
			if($user){  //se esiste già
				array_push($errors, "email already registered");
				return false;
			}
			$query = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
			if(!mysqli_query($db, $query)){
				throw new Exception("Error Processing Request", 1);
			}
			if(!mysqli_commit($db)){
				throw Exception("Commit failed");
			}

			//todo: nuova sessione + cookies

			mysqli_autocommit($db, true);
			mysqli_close($db);
			header('location: index.php'); //redirect a index.php
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


?>