<?php
$db = dbConnection();
//mysqli_query($db, 'INSERT INTO users VALUES ("simone","ciao")'); FUNZIONA

if(isset($_POST['register_user'])){
	header('location: index.php');
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
	
?>