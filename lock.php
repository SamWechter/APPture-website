<?php
	 session_start();
	 
	 // Checks if the user's IP and email address have been stored in session variables
	 if($_SESSION['login_ip'] && $_SESSION['login_email']) {
		  // Checks if the user is currently on the same IP address as the one they logged on with
		  // 	This is intended to assist in the prevention of session hijacking
		  $loginIP = $_SESSION['login_ip'];
		  //echo "Login IP: $loginIP <br/>Current IP: " . $_SERVER['REMOTE_ADDR'] . "<br/>";
		  if($loginIP == $_SERVER['REMOTE_ADDR']) {
				$loginEmail = $_SESSION['login_email'];
				
				
				// The following javascript echo line is deprecated and will be removed in the future
				// Echos a javascript variable to indicate that the user is logged in
				// This variable was used to determine if the login form or logout button should be
				//  showing
				//  Also echos the user's email address for UI purposes
				/*echo '
				  <script>
					 var loginCheck = true;
					 var loginEmail = "' . $loginEmail . '";
				  </script>';*/
				
				
		  } else {
				// Login IP and current IP do not match
				header("Location: login.php");
				exit();
		  }
		  
	 } else {
		  // Login IP and/or login email are not active session variables
		  header("Location: login.php");
		  exit();
	 }
	 
	 /*if($loginIP == $_SERVER['REMOTE_ADDR'] && $_SESSION['login_email']) {
		  $user_ip = $_SESSION['user_ip'];
		  $user_email = $_SESSION['user_email'];
		  //echo "<h1>$user_ip</h1>\n";
		  // Echos a javascript variable to indicate that the user is logged in
		  // This variable is used to determine if the login form or logout button should be
		  //  showing
		  echo "
			 <script>
				var loginCheck = true;
				var loginEmail = $user_email;
			 </script>";
	 } else {
		  //echo "<h1>IP Address not found.</h1>\n";
		  //echo "Session not found.";
		  /*header("Location: logout.php");
		  exit();
	 }*/

?>