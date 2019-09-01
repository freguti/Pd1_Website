<div class="col-md-2 mynavbar">  
  <nav>

    <ul class="navbar-nav">
    	<?php 
    		if(isset($_SESSION['email'])){
			  echo "
            <li class='nav-item'>
              <a href='logout.php' class='myelement'>Logout</a>
			</li>
			<li class='nav-item'>
			  <a href='#' class='btn btn-primary' id='btnbook'>Prenota selezione</a>
			</li>
			<li class='nav-item'>
			  <a href='#' class='btn btn-primary' id='btnerase'>Cancella prenotazione</a>
            </li>
      		";
    		} else {
				echo "
				<li class='nav-item'>
				<a href='index.php' class='myelement'>Pagina Principale</a>
			  	</li>
    			<li class='nav-item'>
      		  		<a href='login.php' class='myelement'>Login</a>
      			</li>
      			<li class='nav-item'>
      		  		<a href='register.php' class='myelement'>Registrazione</a>
      			</li>
      		";
    		}
    	?>
    </ul>
  </nav>
</div>