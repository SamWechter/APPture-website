<?php
	 require_once('LIB_Appture.php');
	 
	 //echo "<h1>Logging in...</h1>";
	 if($_POST['loginSubmit']) {
		  $userEmail = $_POST['loginEmail'];
		  $userPass = $_POST['loginPassword'];
		  $mysqli = get_connection();
		  $uid = get_user_id( $mysqli, $userEmail );
		  if($uid > 0) {
				if( compare_user_password($mysqli,$uid,$userPass) ) {
					 session_start();
					 // Stores the user's email address in a session variable
					 global $userEmail;
					 //session_register($userEmail);
					 $_SESSION['login_email'] = $userEmail;
					 // Stores the user's login IP in a session variable
					 $login_ip = $_SERVER['REMOTE_ADDR'];
					 //session_register($user_ip);
					 $_SESSION['login_ip'] = $login_ip;
					 header('Location: account.php');
					 exit();
				} else {
					 header('Location: login.php');
					 exit();
				}
		  } else {
				header('Location: login.php');
				exit();
		  }
		  $mysqli->close();
		  //echo $userEmail;
	 }
?>