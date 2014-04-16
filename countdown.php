<?php
	 require_once('lock.php');
?>
<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
    <title>MOSIS Alpha Countdown</title>
  <!--Styles-->

    
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
  

	 <?php
		  require_once("templates/ga.php");
	 ?>
</head>
<body>

	<!-- PHP navbar template -->  
	 <?php
		  require_once("templates/navbar.php");
	 
	 ?>
 
<!--Mosis Countdown Div-->
	 <br/>
	 <br/>
	 <div class="row" id="countdownDiv">
		  <div class="large-7 large-centered columns">
				<div class="log">
					 <div class="main">MOSIS Alpha Countdown</div>
					 <div class="panel radius1">
						  <div class="row">
								<div class="large-7 large-centered columns">
									 <countdown id="countdownPlace"></countdown>
								</div>
						  </div>
					 </div>
				</div>
				<div class="rext">There are currently <text class="queueSizeText">X</text> registered users for Alpha.</div>
		  </div>
		  
		  <br/>
		  <br/>
	 </div>

<!--Javascript below here-->
	
	
  <script>
  document.write('<script src=' +
  ('__proto__' in {} ? 'js/vendor/zepto' : 'js/vendor/jquery') +
  '.js><\/script>')
  </script>
  
  <?php
	 echo '<script>currentEmail="' . $_SESSION['login_email'] . '"</script>';
  ?>
  
	<script>
		  window.onload = function() {
				sendQueueSizeAjax();
				sendCountdownAjax();
		  };
		  function sendCountdownAjax() {
				var myAjaxObject = getAjaxObject();
		  
				if(myAjaxObject) {
					 //alert('login submit');
					 myAjaxObject.onreadystatechange = function() {
						  //alert("AJAX");
						  if( myAjaxObject.readyState == 4 ) {
								if( myAjaxObject.status == 200 ) {
									 parseCountdownResponse( myAjaxObject.responseText );
								}
						  }
					 }
					 if( currentEmail.length > 0 ) {
						  var countdownParameters = "countdownEmail=" + currentEmail;
						  myAjaxObject.open("POST", "http://www.appture.org/countdownCheck.php", true);
						  myAjaxObject.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						  myAjaxObject.send( countdownParameters );
					 } else {
						  alert( "An error has occurred in retrieving your place in line for MOSIS." );
					 }
				} else {
					 alert("NO AJAX");
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
					 alert("NO AJAX");
				}
		  }
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
		  function parseCountdownResponse( jsonResponse ) {
				var parsedJsonResponse = JSON.parse( jsonResponse );
				//alert(parsedJsonResponse.response);
				if(parsedJsonResponse.response != "error") {
					 document.getElementById("countdownPlace").appendChild( document.createTextNode( "You are " + parsedJsonResponse.response + " out of " + queueSize + " in line for the MOSIS Alpha." ) );
					 //toggleCenterDiv("login");
				} else {
					 alert("An error has occurred in retrieving your place in line for MOSIS.");
				}
		  }
	</script>
	
  <script src="js/foundation.min.js"></script>
   <script src="js/foundation/foundation.js"></script>
    
  <script src="js/foundation/foundation.forms.js"></script>
   <script src="js/foundation/foundation.reveal.js"></script>
  <!--
  
  <script src="js/foundation/foundation.js"></script>
  
  <script src="js/foundation/foundation.alerts.js"></script>
  
  <script src="js/foundation/foundation.clearing.js"></script>
  
  <script src="js/foundation/foundation.cookie.js"></script>
  
  <script src="js/foundation/foundation.dropdown.js"></script>
  
  <script src="js/foundation/foundation.forms.js"></script>
  
  <script src="js/foundation/foundation.joyride.js"></script>
  
  <script src="js/foundation/foundation.magellan.js"></script>
  
  <script src="js/foundation/foundation.orbit.js"></script>
  
  <script src="js/foundation/foundation.reveal.js"></script>
  
  <script src="js/foundation/foundation.section.js"></script>
  
  <script src="js/foundation/foundation.tooltips.js"></script>
  
  <script src="js/foundation/foundation.topbar.js"></script>
  
  <script src="js/foundation/foundation.interchange.js"></script>
  
  <script src="js/foundation/foundation.placeholder.js"></script>
  
  <script src="js/foundation/foundation.abide.js"></script>
  
  -->
  
  <script>
    $(document).foundation();
  </script>
  
</body>
</html>
