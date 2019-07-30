<?php
$db = dbConnection();
//mysqli_query($db, 'INSERT INTO users VALUES ("simone","ciao")'); FUNZIONA

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