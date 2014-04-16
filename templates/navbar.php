<?php
	 echo '<div class="headBox">
  
		<div class="logoSpacer"><img class="logo" src="images/logob.png"/>
		
		  <ul class="rightLink">
			
					 <li class="pag"><a class="mainLink" href="index.php">Home</a></li>';
					 
	 if( !($_SESSION['login_ip'] && $_SESSION['login_email']) ) {
		  echo '<li class="pag"><a class="mainLink" href="register.php">Register</a></li>';
	 }
	 
	 echo '<li class="pag"><a class="mainLink" href="login.php">My Account';
	 
	 if($_SESSION['login_ip'] && $_SESSION['login_email']) {
		  echo ' ( ' . $_SESSION['login_email'] . ' )';
	 }
	 
	 echo '</a></li>';
	 /*echo '<li class="pag"><a class="mainLink" href="#">Donate</a></li>
					 <li class="pag"><a class="mainLink" href="#">Contact</a></li>';*/
					 
	 if($_SESSION['login_ip'] && $_SESSION['login_email']) {				 
		  echo '<li class="pag"><a class="mainLink" href="logout.php">Logout</a></li>';
	 }
	 
	 echo '	  </ul>
		
		
		</div>
  
  </div>
  
  <div class="windowspace"></div>';


?>