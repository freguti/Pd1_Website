<?php
include('server.php');
session_destroy();
if (ini_get("session.use_cookies")) {
	$params = session_get_cookie_params();
 setcookie(session_name(), '', time() - 3600*24, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}
echo 'Hai effettuato il Log-out con successo. <a href="index.php">Home page</a>';
?>