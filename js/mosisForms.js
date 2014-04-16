var currentEmail = "";
var queueSize;

function prepareForm() {
	 sendQueueSizeAjax();
	 // register link event listener
	 document.getElementById("registerLink").addEventListener("click", function() {
		  toggleCenterDiv("register");
	 });
	 
	 // login submit button event listener
	 document.getElementById("loginSubmitBtn").addEventListener( "click", sendLoginAjax );
	 
	 // register submit button event listener
	 document.getElementById("registerSubmitBtn").addEventListener( "click", sendSignupAjax );
}
function toggleCenterDiv( divType ) {
	 var loginDiv = document.getElementById("loginDiv");
	 var signupDiv = document.getElementById("signupDiv");
	 var countdownDiv = document.getElementById("countdownDiv");
	 if(divType == "register") {
		  loginDiv.style.display = "none";
		  signupDiv.style.display = "block";
		  countdownDiv.style.display = "none";
		  //centerDivMode = "signup";
	 } else if(divType == "countdown") {
		  loginDiv.style.display = "none";
		  signupDiv.style.display = "none";
		  countdownDiv.style.display = "block";
		  //centerDivMode = "login";
	 } else {
		  loginDiv.style.display = "block";
		  signupDiv.style.display = "none";
		  countdownDiv.style.display = "none";
	 }
}
function sendLoginAjax(e) {
	 var myAjaxObject = getAjaxObject();

	 if(myAjaxObject) {
		  //alert('login submit');
		  myAjaxObject.onreadystatechange = function() {
				//alert("AJAX");
				if( myAjaxObject.readyState == 4 ) {
					 if( myAjaxObject.status == 200 ) {
						  parseLoginResponse( myAjaxObject.responseText );
					 }
				}
		  }
		  var loginEmail = document.getElementById("loginEmail").value;
		  currentEmail = loginEmail;
		  var loginPassword = document.getElementById("loginPassword").value;
		  if( ( loginEmail.length > 0 ) && ( loginPassword.length > 0 ) ) {
				var loginParameters = "loginSubmit=duh&loginEmail=" + loginEmail + "&loginPassword=" + loginPassword;
				myAjaxObject.open("POST", "http://www.appture.org/mosisLoginCheck.php", true);
				myAjaxObject.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				myAjaxObject.send( loginParameters );
		  } else {
				alert( "Please enter your email address and password." );
		  }
	 } else {
		  alert("NO AJAX");
	 }
}
function sendSignupAjax(e) {
	 var myAjaxObject = getAjaxObject();

	 if(myAjaxObject) {
		  //alert('signup submit');
		  myAjaxObject.onreadystatechange = function() {
				//alert("AJAX");
				if( myAjaxObject.readyState == 4 ) {
					 if( myAjaxObject.status == 200 ) {
						  parseSignupResponse( myAjaxObject.responseText );
					 }
				}
		  }
		  var signupPassword = document.getElementById("signupPassword").value;
		  var signupPasswordConfirm = document.getElementById("signupPasswordConfirm").value;
		  if( ( signupPassword == signupPasswordConfirm ) && ( signupPassword.length > 0 ) ) {
				var signupFName = document.getElementById("signupFName").value;
				var signupLName = document.getElementById("signupLName").value;
				var signupOrganization = document.getElementById("signupOrganization").value;
				var signupEmail = document.getElementById("signupEmail").value;
				var signupParameters = "signupSubmit=1&signupFName=" + signupFName + "&signupLName=" + signupLName +
					 "&signupOrganization=" + signupOrganization + "&signupEmail=" + signupEmail + "&signupPassword=" + signupPassword
					 + "&signupBeta=1";
				myAjaxObject.open("POST", "http://www.appture.org/adduser.php", true);
				myAjaxObject.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				myAjaxObject.send( signupParameters );
		  } else {
				alert( "Your passwords don't match!" );
		  }
	 } else {
		  alert("NO AJAX");
	 }
}
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
function parseLoginResponse( jsonResponse ) {
	 var parsedJsonResponse = JSON.parse( jsonResponse );
	 //alert(parsedJsonResponse.response);
	 if(parsedJsonResponse.response == "ok") {
		  toggleCenterDiv("countdown");
		  sendCountdownAjax();
	 } else {
		  currentEmail = "";
		  alert("You have entered an incorrect email address or password. Please try again.");
	 }
}
function parseSignupResponse( jsonResponse ) {
	 var parsedJsonResponse = JSON.parse( jsonResponse );
	 //alert(parsedJsonResponse.response);
	 if(parsedJsonResponse.response == "ok") {
		  sendQueueSizeAjax();
		  toggleCenterDiv("login");
	 } else {
		  alert("An error occurred while attempting to register your new account. Sorry about that! Please try again.");
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