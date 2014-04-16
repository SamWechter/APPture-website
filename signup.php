<!DOCTYPE html>

<html lang="en-us">

<head>
	<meta name="viewport" content="width=device-width, maximum-scale=1.0"> 
	<META HTTP-EQUIV="pragma" CONTENT="no-cache"/>


    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" />
    <meta name="description" content="Liquid Slider : A JQuery Slider Plugin" />

    
    <link rel="stylesheet" type="text/css" media="screen" href="./css/liquid-slider.css"/>
	
	<link rel="stylesheet" type="text/css" media="screen" href="./css/style.css"/>
	
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
      function comparePassInputs() {
        var pass1 = document.getElementById("signupPassword").value;
        var pass2 = document.getElementById("signupPasswordConfirm").value;
        var submitBtn = document.getElementById("signupSubmit");
        var passMatchLabel = document.getElementById("passMatchLabel");
        if (pass1 == pass2) {
          submitBtn.disabled = false;
          passMatchLabel.style.display = "none";
        } else {
          submitBtn.disabled = true;
          passMatchLabel.style.display = "block";
        }
      }
    </script>
	
	  
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
  
  <div class="headBox">
  
		<div class="logoSpacer"><img class="logo" src="images/logob.png"/>
		
		<ul class="rightLink">
			
			<li class="pag"><a class="mainLink" href="index.html">Home</a></li>
			<li class="pag"><a class="mainLink" href="#">Donate</a></li>
			<li class="pag"><a class="mainLink" href="#">Contact</a></li>
		
		</ul>
		
		
		</div>
  
  </div>
  
  <div class="windowspace"></div>
  
  <div id="signupFormContainer">
	 <form id="signupForm" method="POST" action="adduser.php">
		  Email address:
		  <input type="text" name="signupEmail"/>
		  <br/>
		  Password:
		  <input type="password" name="signupPassword" id="signupPassword" onkeyup="comparePassInputs();"/>
		  <br/>
		  Confirm Password:
		  <input type="password" name="signupPasswordConfirm" id="signupPasswordConfirm" onkeyup="comparePassInputs();"/>
		  <br/>
		  <label id="passMatchLabel" style="display: none;">Your passwords do not match.</label>
		  First Name:
		  <input type="text" name="signupFName"/>
		  <br/>
		  Last Name:
		  <input type="text" name="signupLName"/>
		  <br/>
		  Organization (optional):
		  <input type="text" name="signupOrganization"/>
		  <br/>
		  <input type="checkbox" name="signupTerms" id="signupTerms"/> I agree to Appture's Terms and Conditions for user registration.
		  <br/>
		  <input type="checkbox" name="signupBeta" id="signupBeta"/> I would like to sign up for the MOSIS product beta.
		  <br/>
		  <input type="submit" name="signupSubmit" id="signupSubmit" value="Sign up!" disabled/>
	 </form>
  </div>

	  
<div class="footBox">
	
	<div class="ftcontain">
	
		<div class="left">
	
			<div class="topMar"><p class="big1">Be new and creative</p></div>
			<p class="small">Designing New Experiences</p>
	
			<div class="spacerFT"></div>
	
			<ul><li class="socialMedia">.Connect</li> 
			
			<li class="socialLink"><a class="socialWink" href="#">facebook</a></li> 
			<li class="socialLink"><a class="socialWink" href="#">twitter</a></li> 
			<li class="socialLink"><a class="socialWink" href="#">linkedIn</a></li></ul>
		
	
	
		</div>
	
		<div class="right">
	
			<div class="topMar"><p class="big2">We make stuff</p></div>
			<p class="big1"><a class="email" href="#">appture@outlook.com</a></p>
			<p class="big3">315-745-9860</p>
	
		
			<p class="copyright">&#169; Copyright 2013, Appture LLC.</p>
	
		</div>
		
		
	</div>		
		
		
		
		
	
	</div>
	
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
	  
	  
  </body>


  
  
  
</html>
