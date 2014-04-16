<?php
	 require_once "admin/mysql.php";
	 
	 // global variables
	 $gHostName = "REMOVED_DATABASE_URL";
	 $gUserName = "REMOVED_USERNAME";
	 $gPassword = appture_bot_p;
	 $gDBName = "REMOVED_DATABASE_NAME";
	 
	 function get_connection() {
		  global $gHostName, $gUserName, $gPassword, $gDBName;
		  $mysqli = new mysqli($gHostName,$gUserName,$gPassword,$gDBName);
		  if($mysqli->connect_error) {
				echo("Error: " . mysqli_connect_error());
				exit();
		  }
		  return $mysqli;
	 }
	 
	 function get_user_id( $mysqli, $userEmail ) {
		  $tableName = "users";
		  $query = "SELECT id FROM $tableName WHERE Email=?";
		  $values = array();
		  $values[] = $userEmail;
		  $types = "s";
		  $stmt = $mysqli->stmt_init();
		  if( $stmt->prepare( $query ) ) {
				$stmt->bind_param( $types, $values[0] );
				$stmt->execute();
				$stmt -> bind_result($result);
				$stmt -> fetch();
				return($result);
		  } else {
				echo "<h3>".$stmt->error."</h3>";
				return(0);
		  }
	 }
	 
	 function signup_beta( $mysqli, $userID ) {
		  $tableName = "beta_queue";
		  $query = "INSERT INTO $tableName (queue_position, user_id) VALUES (?, ?)";
		  $values = array();
		  $values[] = null;
		  $values[] = $userID;
		  $types = "ii";
		  $stmt = $mysqli->stmt_init();
		  if( $stmt->prepare( $query ) ) {
				$stmt->bind_param( $types, $values[0], $values[1] );
				$stmt->execute();
				//echo "<h3>".$stmt->error."</h3>";
				//echo "You have been signed up for the mosis beta!";
		  } else {
				//echo "<h3>".$stmt->error."</h3>";
		  }
	 }
	 
	 // Function stub for beta access activation
	 function activate_beta( $mysqli, $userID ) {
		  // Code goes here!
	 }
	 
	 function get_current_beta_queue_pos( $aSqli, $userID ) {
		  $lowestQueuePosValue = get_lowest_beta_queue_pos( $aSqli );
		  $queuePos = get_beta_queue_pos( $aSqli, $userID );
		  $actualQueuePosition = $queuePos - $lowestQueuePosValue;
		  return($actualQueuePosition);
	 }
	 
	 function get_lowest_beta_queue_pos( $aSqli ) {
		  $tableName = "beta_queue";
		  $queuePosColName = "queue_position";
		  $query = "SELECT MIN($queuePosColName) FROM $tableName";
		  
		  $stmt = $aSqli->stmt_init();
		  if( $stmt->prepare( $query ) ) {
				$stmt->execute();
				$stmt -> bind_result($result);
				$stmt -> fetch();
				return($result);
		  } else {
				echo "<h3>".$stmt->error."</h3>";
				return(0);
		  }
	 }
	 
	 function get_highest_beta_queue_pos( $aSqli ) {
		  $tableName = "beta_queue";
		  $queuePosColName = "queue_position";
		  $query = "SELECT MAX($queuePosColName) FROM $tableName";
		  
		  $stmt = $aSqli->stmt_init();
		  if( $stmt->prepare( $query ) ) {
				$stmt->execute();
				$stmt -> bind_result($result);
				$stmt -> fetch();
				return($result);
		  } else {
				echo "<h3>".$stmt->error."</h3>";
				return(0);
		  }
	 }
	 
	 function get_current_highest_beta_queue_pos( $aSqli ) {
				$highestPos = get_highest_beta_queue_pos( $aSqli );
				$currentHighestPos = $highestPos - get_lowest_beta_queue_pos( $aSqli );
				return($currentHighestPos);
		  
	 }
	 
	 function get_beta_queue_pos( $aSqli, $userID ) {
		  $tableName = "beta_queue";
		  $idColName = "user_id";
		  $queuePosColName = "queue_position";
		  $query = "SELECT $queuePosColName FROM $tableName WHERE $idColName=?";
		  
		  $stmt = $aSqli->stmt_init();
		  if( $stmt->prepare( $query ) ) {
				$stmt->bind_param( "s", $userID );
				$stmt->execute();
				$stmt -> bind_result($result);
				$stmt -> fetch();
				return($result);
		  } else {
				echo "<h3>".$stmt->error."</h3>";
				return(0);
		  }
	 }
	 
	 function get_account_details( $mysqli, $userID ) {
		  $tableName = "users";
		  $idColName = "id";
		  $fNameColName = "FirstName";
		  $lNameColName = "LastName";
		  $emailColName = "Email";
		  $organizationColName = "Organization";
		  
		  $query = "SELECT $fNameColName, $lNameColName, $emailColName, $organizationColName FROM $tableName WHERE $idColName = ?";
		  $stmt = $mysqli->stmt_init();
		  if( $stmt->prepare( $query ) ) {
				$stmt->bind_param( "i", $userID );
				$stmt->execute();
				$stmt -> bind_result($userFName, $userLName, $userEmail, $userOrganization);
				$stmt -> fetch();
				$results = array($userFName, $userLName, $userEmail, $userOrganization);
				return $results;
		  } else {
				echo "<h3>".$stmt->error."</h3>";
		  }
	 }
	 
	 function compare_user_password($uSqli,$userID,$userPassword) {
		  // space_giraffes was a codename for the user login info table
		  $tableName = "space_giraffes";
		  $passColName = "hash";
		  $query = "SELECT $passColName FROM $tableName WHERE user_id=?";
		  $values = array();
		  $values[] = $userID;
		  $types = "i";
		  $stmt = $uSqli->stmt_init();
		  if( $stmt->prepare( $query ) ) {
				$stmt->bind_param( $types, $values[0] );
				if($stmt->execute()) {
					 $stmt -> bind_result($result);
					 $stmt -> fetch();
					 if(crypt($userPassword, $result) == $result) {
						  //echo "GREAT SUCCESS!";
						  /*session_start();
						  // Stores the user's email address in a session variable
						  global $userEmail;
						  //session_register($userEmail);
						  $_SESSION['login_email'] = $userEmail;
						  // Stores the user's login IP in a session variable
						  $login_ip = $_SERVER['REMOTE_ADDR'];
						  //session_register($user_ip);
						  $_SESSION['login_ip'] = $login_ip;
						  header('Location: account.php');
						  exit();*/
						  return true;
					 } else {
						  /*header('Location: login.php');
						  exit();*/
						  return false;
					 }
				}
		  } else {
				//echo "<h3>".$stmt->error."</h3>";
				return false;
		  }
	 }
?>