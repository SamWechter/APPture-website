<?php
		  session_start();
?>
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
	
	
	
    <title>Appture .LLC</title>
</head>
  
<body class='no-js' style="margin:0 auto">
		
		  <!-- PHP navbar template -->  
  <?php
		  require_once("templates/navbar.php");
  
  ?>
  
  <!-- Old static nav bar -->
  <!-- <div class="headBox">
  
		<div class="logoSpacer"><img class="logo" src="images/logob.png"/>
		
		  <ul class="rightLink">
			
					 <li class="pag"><a class="mainLink" href="index.html">Home</a></li>
					 <?php
								/*echo '<li class="pag"><a class="mainLink" href="login.php">My Account';
								echo ' ( ' . $_SESSION['login_email'] . ' )';
								echo '</a></li>';*/
					 ?>
					 <li class="pag"><a class="mainLink" href="#">Donate</a></li>
					 <li class="pag"><a class="mainLink" href="#">Contact</a></li>
					 <li class="pag"><a class="mainLink" href="logout.php" id="logoutAnchor" style="display: none">Logout</a></li>
		
		  </ul>
		
		
		</div>
  
  </div>
  
  <div class="windowspace"></div>

  -->
  
<div class="contentCon">
  
	<div class="spacer"></div>
  
      <div class="liquid-slider"  id="slider-id">
        <div>
          <h2 class="title"></h2>
          <img class="imgRe" src="images/2.png" width="100%" height"350px"/>
        </div>
        <div>
          <h2 class="title"></h2>
		  <img class="imgRe" src="images/mosis.png" width="100%" height"350px"  /> 
        </div>             
      </div>
 
	 <div class="hard">
	  
	  <p class="bigFon1">What is APPture?</p>
	  
	  <p class="readFont">We are APPture LLC, our name stems from the words&#58; Rapture, Venture, and Application. We apply our intense passion for technology to undertake ventures which will &lsquo;put a dent in the world&rsquo;.</p>
	  
	</div>
	  
	
</div>

	
	 
	 <div class="spacer2"></div>
	 
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
			<p class="big1"><a class="email" href="#">contact@appture.org</a></p>
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
		  <?php
					 session_start();
					 if($_SESSION['login_ip'] && $_SESSION['login_email']) {
								echo '
										  <script>
													 document.getElementById("logoutAnchor").style.display="inline";
										  </script>';
					 }
		  ?>
	  
  </body>


  
  
  
</html>
