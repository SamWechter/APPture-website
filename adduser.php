<?php
	 header("Access-Control-Allow-Origin: *");
	 header('Content-Type: application/json; charset=utf-8');
	 require_once('LIB_Appture.php');

	 $validForm = true;
	 // Stores new user id
	 $user_id;
	 
	 $response_json = '{ "response": ';
	 
	 if (!isset($_POST['signupSubmit'])) {
		  $validForm = false;
	 } else {
		  if ( (isset($_POST['signupFName'])) && (strlen($_POST['signupFName'])) ) {
				$tmpFName = $_POST['signupFName'];
		  } else {
				$validForm = false;
				//echo "I don't know your first name.";
		  }
		  if ( (isset($_POST['signupLName'])) && (strlen($_POST['signupLName'])) ) {
				$tmpLName = $_POST['signupLName'];
		  } else {
				$validForm = false;
				//echo "I don't know your last name.";
		  }
		  if ( (isset($_POST['signupOrganization']))  && (strlen($_POST['signupOrganization'])) ) {
				$tmpOrganization = $_POST['signupOrganization'];
		  } else {
				$tmpOrganization = "";
		  }
		  if ( (isset($_POST['signupPhone']))  && (strlen($_POST['signupPhone']) > 10) ) {
				$tmpPhone = $_POST['signupPhone'];
		  } else {
				$tmpPhone = "";
		  }
		  if ( (isset($_POST['signupEmail'])) && (strlen($_POST['signupEmail'])) ) {
				$tmpEmail = $_POST['signupEmail'];
		  } else {
				$validForm = false;
				//echo "I don't know your email address.";
		  }
		  if ( (isset($_POST['signupUse'])) && (strlen($_POST['signupUse'])) ) {
				$tmpUse = $_POST['signupUse'];
		  } else {
				$validForm = false;
		  }
		  if ( (isset($_POST['signupReferral'])) && (strlen($_POST['signupReferral'])) ) {
				$tmpReferral = $_POST['signupReferral'];
		  } else {
				$validForm = false;
		  }
		  if ( (isset($_POST['signupPassword'])) && (strlen($_POST['signupPassword'])) ) {
				$newPass = $_POST['signupPassword'];
		  } else {
				$validForm = false;
				//echo "Invalid password.";
		  }
	 }
	 
	 if ($validForm) {
		  $tmpSqli = get_connection();
		  // Check if a user already exists with the entered email address
		  $uid = get_user_id( $tmpSqli, $tmpEmail );
		  if($uid <= 0) {
				add_new_user($tmpSqli,$tmpFName,$tmpLName,$tmpOrganization,$tmpPhone,$tmpEmail,$tmpUse,$tmpReferral);
				add_new_hash( $tmpSqli, $user_id );
				send_validation_email( $tmpEmail, $user_id );
				if($_POST['signupBeta']) {
					 signup_beta( $tmpSqli, $user_id );
				}
				$tmpSqli->close();
				//echo "New user added successfully. Please check your email for a validation message.";
				
				$response_json .= '"ok" }';
				echo $response_json;
		  } else {
				// A user already signed up with the entered email address
				$response_json .= '"error" }';
				echo $response_json;
		  }
	 } else {
		  $response_json .= '"error" }';
		  echo $response_json;
	 }
	 
	 function add_new_user($bSqli,$firstName,$lastName,$organization,$phone,$email,$useReason,$referral) {
		  $newsqli = $bSqli;
		  $tableName = "users";
		  $userIP = $_SERVER['REMOTE_ADDR'];
		  $userMAC = "";
		  $signupDate = null;
		  $query = "INSERT INTO $tableName (id, FirstName, LastName, Organization, PhoneNumber, Email, ReasonForUse, Referral, SignupIP, SignupDate, Validated) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
		  $values = array();
		  $values[] = "";
		  $values[] = $firstName;
		  $values[] = $lastName;
		  $values[] = $organization;
		  $values[] = $phone;
		  $values[] = $email;
		  $values[] = $useReason;
		  $values[] = $referral;
		  $values[] = $userIP;
		  $values[] = $signupDate;
		  $values[] = 0;
		  $types = 'isssssssssi';
		  $stmt = $newsqli->stmt_init();
		  if( $stmt->prepare( $query ) ) {
				$stmt->bind_param( $types, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[9], $values[0]);
				$stmt->execute();
		  } else {
				echo "<h3>".$stmt->error."</h3>";
		  }
		  global $user_id;
		  $user_id = $newsqli->insert_id;
	 }
	 
	 function add_new_hash($hSqli,$hUserId) {
		  $hashTable = "space_giraffes";
		  $hQuery = "INSERT INTO $hashTable (user_id,hash) VALUES(?,?)";
		  $values = array();
		  $values[] = $hUserId;
		  $values[] = crypt($_POST['signupPassword']);
		  $types = "is";
		  $hStmt = $hSqli->stmt_init();
		  if( $hStmt->prepare( $hQuery ) ) {
				$hStmt->bind_param( $types, $values[0], $values[1] );
				$hStmt->execute();
		  } else {
				echo "<h3>".$stmt->error."</h3>";
		  }
	 }
	 
	 function send_validation_email( $email, $userID ) {
		  $mailEmail = $email;
		  $mailSubject = "Please confirm your email address with APPture";
		  $validationURI = "http://www.appture.org/validate.php?uid=" . $userID;
		  $mailMessage = "Thank you for signing up for an account with APPture!

This email is being sent to you in order to validate your email address and account registration. Please click the following link: ";
		  $mailMessage .= $validationURI;
		  $mailMessage .= " to validate your email address. If you did not register for an account with this email address and do not wish to be contacted by us again please email us at support@appture.org.

Thank you for your time,
The APPture Team";
		  $headers = 'From: support@appture.org' . "\r\n" .
				'Reply-To: support@appture.org' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
		  mail($mailEmail,$mailSubject,$mailMessage, $headers);
	 }
	 
	 
?>