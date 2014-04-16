<?php
	 require_once('LIB_Appture.php');
	 require_once('lock.php');
	 
	 if($_POST['detailsSubmit']) {
		  $newEmail = $_POST['detailsEmail'];
		  $newFName = $_POST['detailsFName'];
		  $newLName = $_POST['detailsLName'];
		  $newOrganization = $_POST['detailsOrganization'];
		  
		  $tableName = "users";
		  $fNameColName = "FirstName";
		  $lNameColName = "LastName";
		  $emailColName = "Email";
		  $organizationColName = "Organization" ;
		  $idColName = "id";
		  
		  $amysqli = get_connection();
		  $uid = get_user_id( $amysqli, $_SESSION['login_email'] );
		  $query = "UPDATE $tableName SET $emailColName = ?, $fNameColName = ?, $lNameColName = ?, $organizationColName = ? WHERE $idColName = ?";
		  $values = array();
		  $values[] = $newEmail;
		  $values[] = $newFName;
		  $values[] = $newLName;
		  $values[] = $newOrganization;
		  $values[] = $uid;
			
		  $types = 'ssssi';
		  $stmt = $amysqli->stmt_init();
			if( $stmt->prepare( $query ) ) {
				$stmt->bind_param( $types, $values[0], $values[1], $values[2], $values[3], $values[4] );
				$stmt->execute();
			} else {
				echo "<h3>".$stmt->error."</h3>";
			}
		  
		  
		  $userPass = $_POST['detailsOldPassword'];
		  $newUserPass = $_POST['detailsNewPassword'];
		  $newUserPassConfirm = $_POST['detailsNewPasswordConfirm'];
		  // Checks if all password fields have received input
		  if( (strlen($userPass) > 0) && (strlen($newUserPass) > 0) && (strlen($newUserPassConfirm)) ) {
				// Checks if the [new password] input matches the [new password confirm] input
				if( $newUserPass == $newUserPassConfirm ) {
					 // Checks to see if the user entered their current (old) password correctly
					 if( compare_user_password($amysqli,$uid,$userPass) ) {
						  $passTable = "space_giraffes";
						  $passIdColName = "user_id";
						  $passHashColName = "hash";
						  $passQuery = "UPDATE $passTable SET $passHashColName = ? WHERE $passIdColName = ?";
						  $passValues = array();
						  $passValues[] = crypt($newUserPass);
						  $passValues[] = $uid;
						  
						  $passTypes = "si";
						  $passStmt = $amysqli->stmt_init();
						  if( $passStmt->prepare( $passQuery ) ) {
							  $passStmt->bind_param( $passTypes, $passValues[0], $passValues[1] );
							  $passStmt->execute();
							  // User correctly updated their password
							  $passUpdate = true;
						  } else {
								echo "A server error occurred while attempting to process your request. Please try again shortly.";
							  //echo "<h3>".$stmt->error."</h3>";
						  }
					 }
					 else {
						  // User incorrectly entered their current (old) password
						  $incorrectPassword = true;
					 }
				} else {
					 $passMatchFail = true;
				}
		  }
		  // Updates the email session variable to prevent bugs from the user changing their email address
		  $_SESSION['login_email'] = $newEmail;
		  $detailsUpdated = true;
	 }
?>
<html lang="en-us">

<head>
	<meta name="viewport" content="width=device-width, maximum-scale=1.0"> 
	<META HTTP-EQUIV="pragma" CONTENT="no-cache"/>


    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" />
    <meta name="description" content="Appture LLC" />

    
    <link rel="stylesheet" type="text/css" media="screen" href="./css/liquid-slider.css"/>
	
	 <link rel="stylesheet" href="css/foundation.css">
  
	 <link rel="stylesheet" type="text/css" media="screen" href="./css/style.css"/>
	 
	 <link rel="stylesheet" href="css/styles.css" />
	
	<link href='http://fonts.googleapis.com/css?family=Roboto:200,400,500,700' rel='stylesheet' type='text/css'/>

    <!-- Liquid Slider relies on jQuery and easing effects-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="./js/jquery.easing.1.3.js"></script>

    <!-- Optional code for enabling touch -->
    <script src="./js/jquery.touchSwipe.min.js"></script>

    <!-- This is Liquid Slider code. The full version (not .min) is also included in the js directory -->
    <script src="./js/jquery.liquid-slider-custom.min.js"></script>

	<link rel="shortcut icon" href="favicon.ico" ></link>
	
	  
<script>

    $(function(){

     
       $('#slider-id').liquidSlider({
            autoSlide:true,
			autoHeight:true
            
          });
		  
	



      /* If you want to adjust the settings, you set an option
         as follows:

          $('#slider-id').liquidSlider({
            autoSlide:false,
            autoHeight:false
          });     
      */

    });
</script>
	
    <script src="js/accountDetails.js"></script>
	
	
    <title>Appture .LLC</title>
	 <?php
		  require_once("templates/ga.php");
	 ?>
</head>
  
<body class='no-js' style="margin:0 auto">
  
    <!-- PHP navbar template -->  
  <?php
		  require_once("templates/navbar.php");
  
  ?>
  

	 <!--<div id="accountDetailsWrapper">
		  <form id="accountDetailsForm" method="POST" action="accountDetails.php"> -->
				<?php
					 /*$userEmail = $_SESSION['login_email'];
					 $mysqli = get_connection();
					 $uid = get_user_id( $mysqli, $userEmail );
					 $accountDetails = get_account_details( $mysqli, $uid );
					 echo 'Email Address: <input type="text" name="detailsEmail" id="emailField" value="' . $accountDetails[2] . '"/><br/>';
					 echo 'First Name: <input type="text" name="detailsFName" id="fNameField" value="' . $accountDetails[0] . '"/><br/>';
					 echo 'Last Name: <input type="text" name="detailsLName" id="lNameField" value="' . $accountDetails[1] . '"/><br/>';
					 echo 'Organization: <input type="text" name="detailsOrganization" id="organizationField" value="' . $accountDetails[3] . '"/><br/>';
					 $currentBetaPos = get_current_beta_queue_pos( $mysqli, $uid ) + 1;
					 $highestBetaPos = get_current_highest_beta_queue_pos( $mysqli, $uid ) + 1;
					 $mysqli->close();
					 echo "You are $currentBetaPos out of $highestBetaPos in line for the MOSIS beta.";*/
				?>
				<!-- <br/>
				Change password: <input type="password" name="detailsPassword"/><br/>
				Re-enter new password: <input type="password"/><br/>
				<input type="submit" name="detailsSubmit" value="Submit changes"/>
		  </form>
		  <button onclick="window.location = 'logout.php'">Logout</button>
	 </div>-->
	 
	 <!-- Appture Account Details Form -->
	 <?php
		  if($detailsUpdated) {
				echo '<p id="detailsUpdateFeedback">Your account details have been updated.</p>';
		  }
		  if($passUpdate) {
				echo '<p id="passwordUpdateFeedback">Your password has been updated.</p>';
		  }
		  if($incorrectPassword) {
				echo '<p id="incorrectPasswordFeedback">You have incorrectly entered your current password. Please try again.</p>';
		  }
		  if($passMatchFail) {
				echo '<p id="passwordMatchFailFeedback">The new passwords you entered do not match.</p>';
		  }
		  echo '
		  <div class="row" id="accountDetailsWrapper">
				<div class="large-7 large-centered columns">
					 <div class="log">
						  <div class="main">Appture Account Details</div>
						  <button class="small square button" id="editDetailsBtn">Edit Account Details</button>
						  <button class="small square button" id="countdownBtn">MOSIS Alpha Countdown</button>
						  <div class="panel radius1" id="signupForm">
								<form id="accountDetailsForm" method="POST" action="account.php">';
		  
		  $userEmail = $_SESSION['login_email'];
		  $mysqli = get_connection();
		  $uid = get_user_id( $mysqli, $userEmail );
		  $accountDetails = get_account_details( $mysqli, $uid );
		  // Echo first name input
		  echo '
									 <div class="row">
										  <div class="large-7 large-centered columns">
										  First Name: <input type="text" name="detailsFName" placeholder="First Name" id="fNameField" value="' . $accountDetails[0] . '" disabled="false"/>
									 </div>
								</div>';
		  // Echo last name input
		  echo '
									 <div class="row">
										  <div class="large-7 large-centered columns">
										  Last Name: <input type="text" name="detailsLName" placeholder="Last Name" id="lNameField" value="' . $accountDetails[1] . '" disabled/>
									 </div>
								</div>';
		  // Echo organization input
		  echo '
									 <div class="row">
										  <div class="large-7 large-centered columns">
										  Organization: <input type="text" name="detailsOrganization" placeholder="Organization" id="organizationField" value="' . $accountDetails[3] . '" disabled/>
									 </div>
								</div>';
		  echo '<hr/>';
		  // Echo email input
		  echo '
									 <div class="row">
										  <div class="large-7 large-centered columns">
										  Email Address: <input type="text" name="detailsEmail" placeholder="Email Address" id="emailField" value="' . $accountDetails[2] . '" disabled/><br/>
									 </div>
								</div>';
		  echo '<hr/>';
		  // Echo [re-enter current password] input
		  echo '<p>Change password</p>';
		  echo '
									 <div class="row">
										  <div class="large-7 large-centered columns">
										  Re-enter your current password: <input type="password" name="detailsOldPassword" placeholder="Current Password" id="oldPasswordField" disabled/><br/>
									 </div>
								</div>';
		  // Echo [enter new password] input
		  echo '
									 <div class="row">
										  <div class="large-7 large-centered columns">
										  New Password: <input type="password" name="detailsNewPassword" placeholder="New Password" id="newPasswordField" disabled/><br/>
									 </div>
								</div>';
		  // Echo [confirm new password] input
		  echo '
									 <div class="row">
										  <div class="large-7 large-centered columns">
										  Confirm New Password: <input type="password" name="detailsNewPasswordConfirm" placeholder="Confirm New Password" id="newPasswordConfirmField" disabled/><br/>
									 </div>
								</div>';
		  echo '<hr/>';
		  // Echo submit button
		  echo '
					 <div class="bump">
						  <input type="submit" class="medium round button" name="detailsSubmit" id="detailsSubmit" value="Submit" disabled/>
					 </div>';
		  // Close form div
		  echo '</form>
					 </div>
				</div>
		  </div>
	 </div>';
	 
	 ?>
	 <!-- Appture Account Details Form -->

	
	<!--
	   <div class="left">
	   <div class="footTxt3">
	   <p class="big1">Be new and creative</p>
	   <p class="small">Designing New Experiences</p>
	   
	   </div>
	   
	   <div class="socialMedia"><p>.Connect</p></div>
	   <p class="socialLink">facebook  |  twitter  |  linkedIn</p>
	   
	   </div>
		
	   <div class="right"><div class="footTxt">
	   
	   <p class="where"> We make stuff</p>
	   
	   </div>
	   <div class="footTxt2">
	   <p class="fontSpacer"><a href="#">appture@outlook.com</a></p>
	   <p>315-745-9860</p>
	
	   </div>
	    <p class="copyright">&#169; Copyright 2013, Appture LLC.</p>
	   </div>
	
	-->
	
</div>
	  
	<script>
	 window.onload = accountDetailsInit();
	</script>
	  
  </body>


  
  
  
</html>