<?php include('server.php');
	checkCookie();
	checkHttps();
	//checkSession();
	//if(!isset($_SESSION['email'])){
	//	header('location: index.php');
	//  }
	

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
	 <form method="post" onsubmit="return check_psw()">
		 <?php include('errors.php') ?>
          <div class="form-group">
            <label for="email">Inserisci Email:</label>
            <input type="email" class="form-control" name="email" id="email" title="insert email" required />
          </div>
          <div class="form-group">
            <label for="password">Inserisci Password:</label>
            <input type="password" class="form-control" name="password" id="password" required />
			<div id="strength">
			</div>
			<label for="password2">Conferma Password:</label>
            <input type="password" class="form-control" name="password2" id="password2" required />
			<div id="ConfirmPassword">
			</div>
          </div>
          <div class="form-group">
		  	<button id="btnRegister" type="submit" class="btn btn-primary" name="register_user">Register</button>
          </div>
        </form>
		</div> 
	</div>	 
	</div>  
    </body>

    
	<script type="text/javascript">
		 function check_psw(){
			var psw =$("#password").val();
			var confirm = $('#password2').val();
			//alert(psw);
			var result = false;
			if(psw.length < 3){
				//var strength = "weak";
				result = false;
				if(psw != confirm)
					$('#ConfirmPassword').html("Le password devono combaciare!");
				else
					$('#ConfirmPassword').html("");
				
			}
			else
			{
				var special_chars = psw.replace(/[A-Za-z0-9]/g, '');
				var numbers = psw.replace(/[^0-9]/g, '');
				if(special_chars.length >= 2 && numbers.length >= 1)
				{
					//var strength = "strong";
					
					if(psw != confirm)
					{
						$('#ConfirmPassword').html("Le password devono combaciare!");
						result = false;
					}
					else
					{
						result = true;
						$('#ConfirmPassword').html("");
					}
				}
				else
				{
						//var strength = "medium";	
					result = false;
					if(psw != confirm)
						$('#ConfirmPassword').html("Le password devono combaciare!");
					else
					$('#ConfirmPassword').html("");
				}
			}
			
			return result;
			}
		$("#password").on('change keyup paste mouseup',function(){
			var psw =$("#password").val();	
			if(psw.length < 3){
				$("#strength").html("Debole");
				$("#strength").removeClass('strong');
				$("#strength").removeClass('medium');
				$("#strength").addClass('weak');
			}
			else
			{
				var special_chars = psw.replace(/[A-Za-z0-9]/g, '');
				var numbers = psw.replace(/[^0-9]/g, '');
				if(special_chars.length >= 2 && numbers.length >= 1)
				{
					$("#strength").html("Robusta");
					$("#strength").removeClass('weak');
					$("#strength").removeClass('medium');
					$("#strength").addClass('strong');
				}
				else
				{
					$("#strength").html("Media");
					$("#strength").removeClass('weak');
					$("#strength").removeClass('strong');
					$("#strength").addClass('medium');
				}
			}
		});
		</script>
</html>