<?php include('server.php');
	checkHttps();
	checkSession();
	checkCookie();
	$giorno[0] = 'Lunedì';
	$giorno[1] = 'Martedì';
	$giorno[2] = 'Mercoledì';
	$giorno[3] = 'Giovedì';
	$giorno[4] = 'Venerdì';
	$ora_inizio = 8;
	$ora_fine = 9;
?>

<html>
	<head>
		  <link href="./style.css" rel="stylesheet" type="text/css">
		  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		  <script src= "http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"> </script>
 	</head>

 	<body>
	 <?php include('header.php'); ?>
	 <noscript>
    	Javascript is not enabled. Please, enable it!
	</noscript>
	 <div class="container-fluid mycontainer"> 
	 <div class="row myrow">
	 <?php include('navbar.php'); ?>

	 	<div class="col-md-4 mydivform">
	 		<table>
				<?php
				for ($i=0;$i < 10;$i++)
				{
					echo "<tr>";
					
					for($j=0;$j < 5;$j++)
					{
						if ($i == 0)
						{
							echo "<td class='my_cell' id='cell_$i$j'> $giorno[$j] </td>";
						}
						else
						{
							echo "<td class='my_cell' id='cell_$i$j'> dalle $ora_inizio.00 alle $ora_fine.00 </td>";
							
						}
					}
					if ($i != 0){
						$ora_inizio++;
						$ora_fine++;
					}
					echo "</tr>";
				}
				?>
			</table>

		</div> 
	</div>	 
	</div>  
    </body>

    
	<script type="text/javascript">

	</script>