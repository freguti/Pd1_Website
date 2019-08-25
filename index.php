<?php include('server.php');
	checkHttps();
	checkCookie();
	checkSession();	
?>
<html>
	<head>
  		<link href="./style.css" rel="stylesheet" type="text/css">
 	</head>
 	<body>
		<noscript>
		<div style='margin-left:auto;'>
    	Javascript is not enabled. Please, enable it!
		</div>
		</noscript>
		<table>
			<form method="post" action="register.php"> <!-- la pagina php da chiamare (esegue refresh) -->
				<tr>
					debug 
					
					<div>
						<input type="submit" name="invia" value="Registrati">
						<br>
						<input type="button" type="submit" name="invia" value="bottone" onclick="myFunction()">
					</div>
				</tr>
			</form>
		</table>
	</body>
	<script type="text/javascript">

	function myFunction()
	{
		alert("I am an alert box!");
	}
	</script>
</html>

