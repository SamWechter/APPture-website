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

	 <link rel="stylesheet" href="css/foundation.css">
    
	 <link rel="stylesheet" type="text/css" media="screen" href="./css/liquid-slider.css"/>
	
  
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
		  <?php
				require_once("templates/ga.php");
		  ?>
	  <style>
		  .headBox {
				margin: auto !important;
		  }
	  </style>
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
  
	 <?php
		  if($loginFail) {
				echo '<p id="loginFailFeedback">You have entered an incorrect email address or password.</p>';
		  }
	 ?>

<p id="accountCreationFeedback"></p>
<!-- Appture login form -->
<div class="row" id="loginDiv">
		  <div class="large-7 large-centered columns">
				<div class="log">
					 <div class="main">MOSIS Alpha Login</div>
					 <div class="panel radius1" id="loginForm">
						  <form id="loginForm" method="POST" action="loginCheck.php">
								<div class="row">
									 <div class="large-7 large-centered columns">
										  <input type="text" placeholder="Email Address" name="loginEmail" id="loginEmail" />
									 </div>
								</div>
								<div class="row">
									 <div class="large-7 large-centered columns">
										  <input type="password" placeholder="Password" name="loginPassword" id="loginPassword" />
									 </div>
								</div>
								<hr/>
								<div class="bump">
									 <input type="submit" class="medium round button" name="loginSubmit" id="loginSubmitBtn" value="Log in" />
								</div>
						  </form>
					 </div>
				</div>
		  </div>
		  
		  <br/>
		  <br/>
	 </div>
<!-- Appture login form -->
	
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
		  if( (window.localStorage) &&(localStorage.getItem( "newUser" ).length > 0) ) {
				var newUserEmail = localStorage.getItem( "newUser" );
				localStorage.setItem( "newUser", "" );
				document.getElementById("accountCreationFeedback").appendChild(
					 document.createTextNode(
						  "You have successfully created a new account with the email address " + newUserEmail + "! Please log in here to verify your account details."
					 )
				);
				document.getElementById("loginEmail").value = newUserEmail;
		  }
	</script>
	  
  </body>


  
  
  
</html>