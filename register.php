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
            <input type="password" class="form-control" name="password" id="password" minlength="3" required />
          </div>
          <div class="form-group">
            <button id="register" type="submit" class="btn btn-primary" name="register_user">Register</button>
          </div>
          <span id="error"></span>
        </form>
		     
    </body>

    
	<script type="text/javascript">
		 function check_psw(){
			var psw =$("#password").val();
			alert(psw);
			var regexp_psw = new RegExp(/^[A-Za-z0-9]+$/);
			if(regexp_psw.test(psw) || psw.length < 3){
			//$("#error").html("The password must contain at least three characters, one of which is not alphanumeric");
			//$('#error').fadeIn().delay(2000).fadeOut();
			alert("NO");
			return false;
			}
			return true;
		}
	
	</script>
</html>