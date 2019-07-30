<?php include('server.php');

	if(isset($_POST['invia'])) //premendo invia
	{
		display();
	} 

	function display(){
		echo "hello ".$_POST["ciao"]; //stampa hello + contenuto textbox

	}
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
			<form method="post" action="index.php"> <!-- la pagina php da chiamare (esegue refresh) -->
				<tr>
					debug 
					<input type="text" name="ciao">
					<div>
						<input type="submit" name="invia" value="bottone submit">
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

