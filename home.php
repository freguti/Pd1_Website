<?php include('server.php');
if(!isset($_SESSION['email'])){header("Location: index.php");}
    checkHttps();
    checkSession();
	checkCookie();
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
         <form method="post" action= "login.php">
         <?php include('errors.php') ?>


         </form>
     </div> 
	 </div>	 
	 </div>  
    </body>

    <script type="text/javascript">

    </script>
</html>