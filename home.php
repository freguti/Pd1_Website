<?php include('server.php');
	checkCookie();
	checkHttps();
	checkSession();
	if(!isset($_SESSION['email'])){
		header('location: index.php');
	  }
	
	$giorno[1] = 'Lunedì';
	$giorno[2] = 'Martedì';
	$giorno[3] = 'Mercoledì';
	$giorno[4] = 'Giovedì';
	$giorno[5] = 'Venerdì';
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
		 <?php include('errors.php'); ?>
		 <input type="hidden" value="<?php if(isset($_SESSION['email'])){ echo $_SESSION['email'];} ?>" id="session">
	 		<table>
				<?php
				for ($i=0;$i < 10;$i++)
				{
					echo "<tr>";
					for($j=0;$j < 6;$j++)
					{
						if($i == 0 && $j == 0)
							echo "<td class='my_cell_h' id='cell_$i$j'>  </td>";
						else if ($i == 0)
						{
							echo "<td class='my_cell_h' id='cell_$i$j'> $giorno[$j] </td>";
						}
						else if($j == 0)
							echo "<td class='my_cell_l' id='cell_$i$j'>  $ora_inizio.00 </br> - </br>$ora_fine.00 </td>";
						else 
							echo "<td class='my_cell' id='cell_$i$j'>  <div id='div_$i$j'></td>";

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

	var loaded = [];
	$.ajax({
			url: "server.php",
			data: "getcolors",
			type: "GET"
		}).done(function(obj){
			$.each(JSON.parse(obj), function(idx, obj){
				if($('#session').val() == obj[0])
					$('#cell_' + idx).addClass("MyBook");
				
				$('#cell_' + idx).addClass("Booked");
				loaded[idx] = false;
		});
		$('.Booked').mouseover(function(){
			var Cell = $(this).attr("id");
			Cell = Cell.split("_")[1];
			if(!loaded[parseInt(Cell)]){
				loaded[parseInt(Cell)] = true;
				$.ajax({
				url: "server.php",
				data: {postfunctions: 'postemail', arguments: Cell },
				async: false,
				type: "POST"
				}).done(function(obj){
					$.each(JSON.parse(obj), function(idx, obj){
						$("#div_" + idx).html(obj[0] + " prenotato il: " + obj[1]);
					});
				});
			}
		});
		$('.Booked').mouseleave(function(){
			var Cell = $(this).attr("id");
			Cell = Cell.split("_")[1];
			$("#div_" + Cell).empty();
			loaded[parseInt(Cell)] = false;

		});

		$('.my_cell:not(.Booked)').click(function(){
			var clickedCell = $(this).attr("id");
			$('#'+clickedCell).toggleClass('wannaBeBooked');
		});

		});

		var sequence = '00';
		$('#btnbook').click(function(){
			$('.wannaBeBooked').each(function(){
				var SortedCell = $(this).attr("id");
				sequence = sequence + '_' + SortedCell.split("_")[1] ;
			});
			$.ajax({
				url: "server.php",
				data: {postfunctions: 'postclick', arguments: sequence },
				type: "POST"
			}).done(function(data){
				if(data == '-1'){
					alert("session expired");
					window.location.href = "index.php";
				}
				else
				{
					alert(data);
					window.location.href = "home.php";
				}
			});
		});
		
		$('#btnerase').click(function(){
			$.ajax({
				url: "server.php",
				data: "posterase",
				type: "POST"
			}).done(function(data){
				if(data == '-1'){
					alert("session expired");
					window.location.href = "index.php";
				}
				else
				{
					alert(data);
					window.location.href = "home.php";
				}
			});
		})
		
	</script>