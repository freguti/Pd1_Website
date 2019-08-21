<?php include('server.php');

	//if(isset($_POST['invia'])) //premendo invia
	//{

	//	display();
	//} 

	//function display(){
		//$username = $_POST['ciao'];
		//echo "hello ".$username; //stampa hello + contenuto textbox

	//}
?>
<html>
	<head>
  		<link href="./style.css" rel="stylesheet" type="text/css">
 	</head>
 	<body>
		<noscript>
    	Javascript is not enabled. Please, enable it!
		</noscript>
		<table>
			<form method="post" action="register.php"> <!-- la pagina php da chiamare (esegue refresh) -->
				<tr>
					debug 
					<input type="text" name="ciao" default="">
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

