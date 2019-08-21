<?php include('server.php');

?>

<html>
	<head>
  		<link href="./style.css" rel="stylesheet" type="text/css">
		  <script src= "http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"> </script>
 	</head>

 	<body>
	 <form method="post" onsubmit="return check_psw()">
          <div class="form-group">
            <label for="email">Insert Email:</label>
            <input type="text" class="form-control" name="email" id="email" title="insert email" required />
          </div>
          <div class="form-group">
            <label for="password">Insert Password:</label>
            <input type="password" class="form-control" name="password" id="password" required />
          </div>
          <div class="form-group">
		  	<button id="btnRegister" type="submit" class="btn btn-primary" name="register_user">Register</button>
          </div>
          <span id="error"></span>
        </form>
		     
    </body>

    
	<script type="text/javascript">
		 function check_psw(){
			var psw =$("#password").val();
			alert(psw);
			var result = false;
			if(psw.length < 3){
				var strength = "weak";
				result = false;
			}
			else
			{
				var special_chars = psw.replace(/[A-Za-z0-9]/g, '');
				var numbers = psw.replace(/[^0-9]/g, '');
				if(special_chars.length >= 2 && numbers.length >= 1)
				{
					var strength = "strong";
					result = true;
				}
				else
				{
						var strength = "medium";	
						result = false;
				}
			}
			alert(strength);
			return result;
			}
			/*
			$("#btnRegister").click(function(){
			$.ajax({
				url: "server.php",
				data: {postfunctions: "user_register"},
				type: "POST"
			}).done(function(data){
				if(data == "-1"){
					alert("session expired");
					window.location.href = "index.php";
				}
			});
			return true;
		}*/
	
	
	</script>
</html>