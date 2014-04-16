<?php
	 header("Access-Control-Allow-Origin: *");
	 require_once('LIB_Appture.php');
	 
	 $response_json = '{ "response": ';
	 
	 //echo "<h1>Logging in...</h1>";
	 if($_POST['loginSubmit']) {
		  $userEmail = $_POST['loginEmail'];
		  $userPass = $_POST['loginPassword'];
		  $mysqli = get_connection();
		  $uid = get_user_id( $mysqli, $userEmail );
		  if($uid > 0) {
				compare_mosis_user_password($mysqli,$uid,$userPass);
		  } else {
				$response_json .= '"error" }';
				echo $response_json;
		  }
		  $mysqli->close();
		  //echo $userEmail;
	 }
	 
	 
	 function compare_mosis_user_password($uSqli,$userID,$userPassword) {
		  // space_giraffes was a codename for the user login info table
		  $tableName = "space_giraffes";
		  $passColName = "hash";
		  $query = "SELECT $passColName FROM $tableName WHERE user_id=?";
		  $values = array();
		  $values[] = $userID;
		  $types = "i";
		  $stmt = $uSqli->stmt_init();
		  global $response_json;
		  if( $stmt->prepare( $query ) ) {
				$stmt->bind_param( $types, $values[0] );
				if($stmt->execute()) {
					 $stmt -> bind_result($result);
					 $stmt -> fetch();
					 if(crypt($userPassword, $result) == $result) {
						  //echo "GREAT SUCCESS";
						  /*session_start();
						  // Stores the user's email address in a session variable
						  global $userEmail;
						  //session_register($userEmail);
						  $_SESSION['login_email'] = $userEmail;
						  // Stores the user's login IP in a session variable
						  $login_ip = $_SERVER['REMOTE_ADDR'];
						  //session_register($user_ip);
						  $_SESSION['login_ip'] = $login_ip;
						  header('Location: accountDetails.php');
						  exit();*/
						  $response_json .= '"ok" }';
						  echo $response_json;
					 } else {
						  /*header('Location: login.php');
						  exit();*/
						  $response_json .= '"error" }';
						  echo $response_json;
					 }
				} else {
					 $response_json .= '"error" }';
					 echo $response_json;
				}
		  } else {
				$response_json .= '"error" }';
				echo $response_json;
				//echo "<h3>".$stmt->error."</h3>";
		  }
	 }
?>