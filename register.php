<?php
	 session_start();
	 if($_SESSION['login_ip'] && $_SESSION['login_email']) {
		  if($_SESSION['login_ip'] == $_SERVER['REMOTE_ADDR']) {
				header('Location: account.php');
				exit();
		  } else {
				session_destroy();
		  }
	 } 
?>
	 

<!DOCTYPE html>

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

	 <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" ></link>
		  <?php
				require_once("templates/ga.php");
		  ?>
	  
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
	
	
	

  <script src="js/vendor/custom.modernizr.js"></script>
    <title>Appture .LLC</title>
</head>
  
<body class='no-js' style="margin:0 auto">


  
  <!-- PHP navbar template -->  
  <?php
		  require_once("templates/navbar.php");
  ?>
  
 
  <!--
  <div id="loginFormContainer">
	 <form id="loginForm" method="POST" action="loginCheck.php">
		  Email address:
		  <input type="text" name="loginEmail"/>
		  <br/>
		  Password:
		  <input type="password" name="loginPassword"/>
		  <br/>
		  <input type="submit" name="loginSubmit" value="Log in"/>
	 </form>
  </div>
  -->
  
<!-- Appture Signup Form -->
<form id="registerForm" method="POST" action="#" data-abide>
	<div class="row" id="registerDiv">
		<div class="log">
			<div class="main">MOSIS Alpha Registration</div>
			<div class="panel radius1">
				<div class="row">
					<div class="large-7 large-centered columns">
						<div class="input-wrapper">
							<input type="text" placeholder="First Name" id="registerFName" required>
							<small class="error">Please enter your first name.</small>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="large-7 large-centered columns">
						<div class="input-wrapper">
							<input type="text" placeholder="Last Name" id="registerLName" required>
							<small class="error">Please enter your last name.</small>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="large-7 large-centered columns">
						<input type="text" placeholder="Organization" id="registerOrganization">
					</div>
				</div>
				<div class="row">
					<div class="large-7 large-centered columns">
						<div class="input-wrapper">
							<input type="text" placeholder="Phone Number" id="registerPhone" required>
							<small class="error">Please enter your phone number. We will not hand out your phone number to other companies and it will only be used when you request support assistance.</small>
						</div>
					</div>
				</div>
				<hr/>
				<div class="row">
					<div class="large-7 large-centered columns">
						<div class="input-wrapper">
							<input type="email" placeholder="Email Address" id="registerEmail" required>
							<small class="error">Please enter your email address. It will be used to log in to your Appture account.</small>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="large-7 large-centered columns">
						<div class="input-wrapper">
							<input type="password" placeholder="Password" id="registerPassword" required>
							<small class="error">Please enter a valid password. Your password must contain at least one uppercase character, one lowercase character, a number, and a symbol (!, @, #, $, etc...).</small>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="large-7 large-centered columns">
						<div class="input-wrapper">
							<input type="password" placeholder="Confirm Password" id="registerPasswordConfirm" required>
							<small class="error">Please re-enter your password to confirm.</small>
						</div>
					</div>
				</div>
				<hr/>
				<div class="row">
					<div class="large-7 large-centered columns">
						<label for="registerUse">What would you like to use Mosis for?</label>
						<select id="registerUse" class="large">
							<option value="Business">Business</option>
							<option value="Entertainment">Entertainment</option>
							<option value="Education">Education</option>
							<option value="Gaming">Gaming</option>
						</select>
					</div>
				</div>
				<br/>
				<div class="row">
					<div class="large-7 large-centered columns">
						<label for="registerReferral">How did you hear about us?</label>
						<select id="registerReferral" class="large">
							<option value="News">News</option>
							<option value="Appture">Appture Representative</option>
							<option value="Friends">Friends, Family, or Coworker</option>
							<option value="Work">Work</option>
							<option value="School">School</option>
							<option value="Advertisement">Advertisement</option>
						</select>
					 </div>
				</div>
				<hr/>
				<div class="row">
					<div class="bump">
						<a class="medium round button" id="registerSubmitBtn">Submit</a>
					</div>
				</div>
			</div>
			<div class="rext">There are currently <text class="queueSizeText">X</text> registered users for Alpha.</div>
		</div>
	</div>
</form>
<!-- Appture Signup form -->
	  

	
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
		document.write('<script src=js/vendor/'
		  + ('__proto__' in {} ? 'zepto' : 'jquery')
		  + '.js><\/script>');
	</script>
	 <!-- Registration form script -->
	 <script>
		  window.onload = function() {
				// register submit button event listener
				sendQueueSizeAjax();
				document.getElementById("registerSubmitBtn").addEventListener( "click", sendSignupAjax );
		  };
		  
		  function getAjaxObject() {
				if ( window.XMLHttpRequest ) {
					 return new XMLHttpRequest();
				}
				else if ( window.ActiveXObject ) {
					 return new ActiveXObject( "Microsoft.XMLHTTP" );
				}
				else {
					 return false;
				}
		  }
		  function sendQueueSizeAjax() {
				var myAjaxObject = getAjaxObject();
		  
				if(myAjaxObject) {
					 //alert('login submit');
					 myAjaxObject.onreadystatechange = function() {
						  //alert("AJAX");
						  if( myAjaxObject.readyState == 4 ) {
								if( myAjaxObject.status == 200 ) {
									 parseQueueSizeResponse( myAjaxObject.responseText );
								}
						  }
					 }
					 myAjaxObject.open("POST", "http://www.appture.org/getQueueSize.php", true);
					 myAjaxObject.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					 myAjaxObject.send();
				} else {
					 alert("Our registration form is not supported by your web browser. Please try using a different web browser.");
				}
		  }
		  function sendSignupAjax(e) {
				var myAjaxObject = getAjaxObject();
		  
				if(myAjaxObject) {
					 //alert("Signing up...");
					 myAjaxObject.onreadystatechange = function() {
						  //alert("AJAX");
						  if( myAjaxObject.readyState == 4 ) {
								if( myAjaxObject.status == 200 ) {
									 parseSignupResponse( myAjaxObject.responseText );
								}
						  }
					 }
					 var registerPassword = document.getElementById("registerPassword").value;
					 var registerPasswordConfirm = document.getElementById("registerPasswordConfirm").value;
					 if( ( registerPassword == registerPasswordConfirm ) && ( registerPassword.length > 0 ) ) {
						  var registerFName = document.getElementById("registerFName").value;
						  var registerLName = document.getElementById("registerLName").value;
						  var registerOrganization = document.getElementById("registerOrganization").value;
						  var registerPhone = document.getElementById("registerPhone").value;
						  var registerEmail = document.getElementById("registerEmail").value;
						  localStorage.setItem("newUser",registerEmail);
						  currentEmail = registerEmail;
						  var registerUse = document.getElementById("registerUse").value;
						  var registerReferral = document.getElementById("registerReferral").value;
						  var registerParameters = "signupSubmit=1&signupFName=" + registerFName + "&signupLName=" + registerLName + "&signupPhone=" + registerPhone +
								"&signupOrganization=" + registerOrganization + "&signupEmail=" + registerEmail + "&signupUse=" + registerUse + "&signupReferral=" + registerReferral
								+ "&signupPassword=" + registerPassword + "&signupBeta=1";
						  myAjaxObject.open("POST", "http://www.appture.org/adduser.php", true);
						  myAjaxObject.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						  myAjaxObject.send( registerParameters );
					 } else {
						  alert( "Your passwords don't match!" );
					 }
				} else {
					 alert("NO AJAX");
				}
		  }
		  function parseQueueSizeResponse( jsonResponse ) {
				var parsedJsonResponse = JSON.parse( jsonResponse );
				//alert(parsedJsonResponse.response);
				if(parsedJsonResponse.response != "error") {
					 queueSize = parsedJsonResponse.response;
					 var queueSizeTextElements = document.getElementsByClassName("queueSizeText");
					 for( var i = 0; i < queueSizeTextElements.length; i++ ) {
						  queueSizeTextElements[i].innerHTML = queueSize;
					 }
					 //alert(queueSize);
				} else {
					 alert("An error has occurred in retrieving the MOSIS Alpha queue size.");
				}
		  }
		  function parseSignupResponse( jsonResponse ) {
				var parsedJsonResponse = JSON.parse( jsonResponse );
				//alert(parsedJsonResponse.response);
				if(parsedJsonResponse.response == "ok") {
					 sendQueueSizeAjax();
					 window.location = "login.php";
				} else {
					 alert("An error occurred while attempting to register your new account. Sorry about that! Please try again.");
				}
		  }
	 </script>
	
	<script src="js/foundation.min.js"></script>
   <script src="js/foundation/foundation.js"></script>
    
  <script src="js/foundation/foundation.forms.js"></script>
   <script src="js/foundation/foundation.reveal.js"></script>
  <script src="js/foundation/foundation.abide.js"></script>
  <script src="js/foundation/foundation.alerts.js"></script>
	  
	<script>
		$(document).foundation();
	</script>
  </body>


  
  
  
</html>