// Stores the interval for updating the stream div with new image frames
var streamInterval;
// Stores the event handler for the close stream button
var closeStreamHandler = function(){
	 closeStream();
};
// Stores the event handler for the maximize/minimize stream button
var maximizeStreamHandler = function(){
	 maximizeStream();
};
// Stores image width and height for mouse input scaling
var imageNaturalWidth;
var imageNaturalHeight;
// Stores selected devices
var selectedDevicesArray = ["Appture-1","Appture-2","Appture-3","Appture-4"];
// Calls init when the page is loaded
window.onload = init;
// Initializes the application. Called by body onload
function init() {
	 // Hides the splash video after it is finished playing
	 //hideSplash();
	 /** INPUT CAPTURE EVENT LISTENERS **/
	 // Adds eventlisteners for onkeyup and mouse events
	 document.addEventListener("keydown",storeInput,false);
	 // Uses an img tag with an id of "streamImgElement" which is located inside the div with id "streamDiv"
	 var streamImgElement = document.getElementById("streamCanvas");
	 //streamImgElement.addEventListener("mousedown",storeMouseInput,false);
	 //streamImgElement.addEventListener("mouseup",storeMouseInput,false);
	 streamImgElement.addEventListener("click",storeMouseInput,false);
	 // contextmenu == right click == not implemented for our prototype
	 //streamImgElement.addEventListener("contextmenu",storeMouseInput,false);
	 // Still working on implementing double click...
	 //streamImgElement.addEventListener("dblclick",storeMouseInput,false);
	 /** INPUT CAPTURE EVENT LISTENERS **/
	 
	 document.getElementById("devicesTab").addEventListener("click",devicesWindowToggle);
	 
	 // Stores an array of icon buttons. These are the buttons inside each tab's circle
	 var tabIconButton = document.getElementsByClassName("tabIcon");
	 // Loops to 4, the maximum number of available devices
	 for ( var i = 0; i < 4; i++ ) {
		  // Adds an event listener to the tab icon buttons
		  tabIconButton[i].addEventListener('click', function(event) {
				accordionateTab(event);
		  }, true);
	 }
	 displayTabs();
}

function devicesWindowToggle(e) {
	 var devicesWindowDiv = document.getElementById("devicesDiv");
	 var deviceSelectionContainer = document.getElementById("deviceSelectionContainer");
	 if(devicesWindowDiv.getAttribute("toggled") == "no") {
		  devicesWindowDiv.style.display = "block";
		  devicesWindowDiv.setAttribute("toggled","yes");
		  var deviceArray = getDevices();
		  for(var i = 0; i < deviceArray.length; i++) {
				if( i < 10 ) {
					 var newDeviceDiv = document.createElement("div");
					 newDeviceDiv.setAttribute("class","deviceSelectionDiv");
					 // Create checkbox input, sets its attributes, adds an event listener to it, and appends it to newDeviceDiv
					 var newDeviceCheckbox = document.createElement("input");
					 newDeviceCheckbox.setAttribute("type","checkbox");
					 newDeviceCheckbox.setAttribute("class","deviceSelectionCheckBox");
					 newDeviceCheckbox.setAttribute("value",deviceArray[i]);
					 if(selectedDevicesArray.indexOf(deviceArray[i]) > -1) {
						  newDeviceCheckbox.checked = true;
					 }
					 newDeviceCheckbox.addEventListener("click",deviceSelectionHandler);
					 newDeviceDiv.appendChild(newDeviceCheckbox);
					 // Creates an image to represent the device, sets its attributes, and appends it to newDeviceDiv
					 var newDeviceImg = document.createElement("img");
					 newDeviceImg.setAttribute("src","img/icons/tablet.png");
					 newDeviceImg.setAttribute("alt",deviceArray[i]);
					 newDeviceImg.setAttribute("width","100");
					 newDeviceImg.setAttribute("height","100");
					 newDeviceDiv.appendChild(newDeviceImg);
					 // Creates a p to contain information about the device and appends it to newDeviceDiv
					 var newDeviceP = document.createElement("p");
					 var newDevicePText = document.createTextNode(deviceArray[i]);
					 newDeviceP.appendChild(newDevicePText);
					 newDeviceP.appendChild(document.createElement("br"));
					 newDeviceP.appendChild(document.createTextNode("Device OS here"));
					 newDeviceDiv.appendChild(newDeviceP);
					 deviceSelectionContainer.appendChild(newDeviceDiv);
				}
		  }
		  document.addEventListener("keydown",hideDeviceWindow);
	 } else {
		  document.removeEventListener("click",hideDeviceWindow);
		  hideDeviceWindow();
	 }
}
function hideDeviceWindow() {
	 //window.removeEventListener("click",hideDeviceWindow,false);
	 var devicesWindowDiv = document.getElementById("devicesDiv");
	 var deviceSelectionContainer = document.getElementById("deviceSelectionContainer");
	 while(deviceSelectionContainer.firstChild) {
		  deviceSelectionContainer.removeChild(deviceSelectionContainer.firstChild);
	 }
	 devicesWindowDiv.style.display = "none";
	 devicesWindowDiv.setAttribute("toggled","no");
}
function deviceSelectionHandler(e) {
	 var targetDevice = e.target;
	 var deviceCheckboxList = document.getElementsByClassName("deviceSelectionCheckBox");
	 if(selectedDevicesArray.length == 4) {
		  targetDevice.checked = false;
	 }
	 selectedDevicesArray = [];
	 for(var i = 0; i < deviceCheckboxList.length; i++) {
		  if(deviceCheckboxList[i].checked == true) {
				//alert(deviceCheckboxList[i].getAttribute("value"));
				selectedDevicesArray.push(deviceCheckboxList[i].value);
		  }
	 }
	 displayTabs();
	 //alert(selectedDevicesArray);
}
// Gets a list of available devices and returns it as an array
function getDevices() {
	 // A static list of devices. This is where you should call the native function for getting a
	 // 	list of available devices
	 var devices = ["Appture-1","Appture-2","Appture-3","Appture-4","Appture-5","Appture-6","Appture-7","Appture-8","Appture-9","Appture-10"];
	 return devices;
}

/** INPUT CAPTURE EVENT HANDLERS **/
function storeInput(e) {
			  var keyCode = e.keyCode;
			  // Call native function for transferring input here. Pass it keyCode
}
function storeMouseInput(e) {
	 //alert(e.type);
	 var mouseEventType = e.type;
	 var streamImgElement = document.getElementById("streamCanvas");
	 var posX = e.offsetX;
	 var posY = e.offsetY;
	 var xRatio = imageNaturalWidth / streamImgElement.width;
	 var yRatio = imageNaturalHeight / streamImgElement.height;
	 var scaledX = posX * xRatio;
	 var scaledY = posY * yRatio;
	 //alert(streamImgElement.offsetLeft);
	 // Call native function for transferring input here. Pass it mouseEventType, scaledX, and scaledY
	 //document.getElementById("streamHeaderDiv").innerHTML += e.type + " | " + posX + " | " + posY + "<br/>";
	 //document.getElementById("streamHeaderDiv").innerHTML += e.type + "<br/>";
	 //document.getElementById("streamHeaderDiv").innerHTML += "MOUSE X: " + e.pageX + "<br/>";
	 //document.getElementById("streamHeaderDiv").innerHTML += "MOUSE X: " + xRatio + "<br/>";
	 //document.getElementById("streamHeaderDiv").innerHTML += "MOUSE Y: " + yRatio + "<br/>";
}
/** INPUT CAPTURE EVENT HANDLERS **/

// Hides the splash screen. No arguments, no returns
function hideSplash() {
	 // Sets a timeout that'll correspond to the end of the video
	 // Param 1: function call, param 2: delay in milliseconds
	 setTimeout(function() {
		  // Stores a reference to the splash video's frame Div then hides it
		  var splashFrame = document.getElementById("splashDiv");
		  splashFrame.style.display = "none";
		  // Removes the splash video from its frame Div
		  while ( splashFrame.firstChild ) {
				splashFrame.removeChild(splashFrame.firstChild);
		  }
	 },5000);
}
// Displays the (up to) four screen tabs based on the selected device array's length
// 	Takes the array of available devices as an argument and returns nothing
function displayTabs() {
	 // Stores a reference to the Div that will contain the screen tabs
	 var mosisScreensDiv = document.getElementById("mosisScreens");
	 // Checks devicesArray's length and makes the tabs visible accordingly
	 // 	A tab's device's name is stored in the "name" attribute of the tab
	 for( var i = 0; i < 4; i++ ) {
		  mosisScreensDiv.childNodes[1].childNodes[1].style.display = "none";
		  mosisScreensDiv.childNodes[3].childNodes[1].style.display = "none";
		  mosisScreensDiv.childNodes[1].childNodes[3].style.display = "none";
		  mosisScreensDiv.childNodes[3].childNodes[3].style.display = "none";
	 }
	 if( selectedDevicesArray.length > 0 ) {
		  mosisScreensDiv.childNodes[1].childNodes[1].style.display = "block";
		  mosisScreensDiv.childNodes[1].childNodes[1].setAttribute("name", selectedDevicesArray[0]);
	 }
	 if( selectedDevicesArray.length > 1 ) {
		  mosisScreensDiv.childNodes[3].childNodes[1].style.display = "block";
		  mosisScreensDiv.childNodes[3].childNodes[1].setAttribute("name", selectedDevicesArray[1]);
	 }
	 if( selectedDevicesArray.length > 2 ) {
		  mosisScreensDiv.childNodes[1].childNodes[3].style.display = "block";
		  mosisScreensDiv.childNodes[1].childNodes[3].setAttribute("name", selectedDevicesArray[2]);
	 }
	 if( selectedDevicesArray.length > 3 ) {
		  mosisScreensDiv.childNodes[3].childNodes[3].style.display = "block";
		  mosisScreensDiv.childNodes[3].childNodes[3].setAttribute("name", selectedDevicesArray[3]);
	 }
}
// Expands/closes tabs. Takes the click/touchstart event as an argument and returns nothing
function accordionateTab(event) {
	 // Stores an array of references to the screen tabs
	 var tabsArray = document.getElementsByClassName("screenTab");
	 // Stores a reference to the element that was clicked on
	 var targetElement = event.target;
	 // Minimizes all tabs so that when one tab is opened the others will close
	 for( var i = 0; i < tabsArray.length; i++ ) {
		  // Skips over the target element's tab
		  if(tabsArray[i] != targetElement.parentNode) {
				tabsArray[i].setAttribute("expanded","no");
				if(tabsArray[i].getAttribute("side") == "left") {
					 tabsArray[i].style.left = "0px";
				} else if(tabsArray[i].getAttribute("side") == "right"){
					 tabsArray[i].style.right = "0px";
				}
				var tabButtonsDiv = tabsArray[i].childNodes[3];
				tabButtonsDiv.style.display = "none";
		  }
	 }
	 // Expands the tab if it is minimized
	 if(targetElement.parentNode.getAttribute("expanded") == "no") {
		  targetElement.parentNode.setAttribute("expanded","yes");
		  if(targetElement.parentNode.getAttribute("side") == "left") {
				targetElement.parentNode.style.left = "85px";
		  } else if(targetElement.parentNode.getAttribute("side") == "right"){
				targetElement.parentNode.style.right = "85px";
		  }
		  var tabButtonsDiv = targetElement.parentNode.childNodes[3];
		  tabButtonsDiv.style.display = "inline";
	 } else {
		  // Minimizes the tab if it is already expanded
		  targetElement.parentNode.setAttribute("expanded","no");
		  if(targetElement.parentNode.getAttribute("side") == "left") {
				targetElement.parentNode.style.left = "0px";
		  } else if(targetElement.parentNode.getAttribute("side") == "right"){
				targetElement.parentNode.style.right = "0px";
		  }
		  var tabButtonsDiv = targetElement.parentNode.childNodes[3];
		  tabButtonsDiv.style.display = "none";
	 }
}
// Handles touch/click events. The function's name is misleading
//		This function is not currently being used
function touchStartHandler(event) {
	 event.preventDefault();
	 // Stores a reference to the element that was touched/clicked
	 var targetElement = event.target;
	 // Click event handling
	 if( ( event.type == "click" ) ) {
		  if(targetElement.parentNode.getAttribute("expanded") == "no") {
				targetElement.parentNode.setAttribute("expanded","yes");
				targetElement.parentNode.style.width = "30%";
				var tabButtonsDiv = targetElement.parentNode.childNodes[1];
				tabButtonsDiv.style.display = "inline";
		  } else {
				targetElement.parentNode.setAttribute("expanded","no");
				targetElement.parentNode.style.width = "5%";
				var tabButtonsDiv = targetElement.parentNode.childNodes[1];
				tabButtonsDiv.style.display = "none";
		  }
	 }
	 // Touch event handling will go here later
}
// Opens a new connection with the targetted device
// 	Takes the touch/click event and what type of button was used to call the function
// 		as arguments
function openScreen(event) {
	 // Stores a reference to the canvas's frame Div
	 var videoFrame = document.getElementById("streamDiv");
	 // Checks if the application is currently receiving a video stream and, if so,
	 // 	closes the active stream.
	 if(videoFrame.getAttribute("currentStream") == "yes") {
		  // Calls the closeStream function to close the active connection
		  closeStream();
		  // Sets the "Streaming" attribute of the tab for ui purposes.
		  event.target.parentNode.parentNode.parentNode.parentNode.setAttribute("streaming", "no");
		  videoFrame.setAttribute("currentStream","no");
	 }
	 // Checks if the application is currently receiving a video stream and, if not,
	 // 	opens a new stream
	 if(videoFrame.getAttribute("currentStream") == "no") {
		  videoFrame.setAttribute("currentStream","yes");
		  if(event.target.parentNode.parentNode.parentNode.getAttribute("streaming") == "no") {
				// Changes various ui elements
				event.target.parentNode.parentNode.parentNode.childNodes[1].setAttribute("src","img/assets/bubble-on.png");
				videoFrame.style.display = "block";
				var streamHeader = document.getElementById("streamHeaderDiv").childNodes[1];
				streamHeader.childNodes[0].nodeValue = "Currently streaming device: " +
					 event.target.parentNode.parentNode.parentNode.getAttribute("name");
				event.target.parentNode.parentNode.parentNode.parentNode.setAttribute("streaming", "yes");
				// Opens a connection and looks for a stream from the targetted device
				startStream();
		  }
	 }
}
// Hides the canvas's frame Div. Not currently being used.
function closeScreen() {
	 var videoFrame = document.getElementById("streamDiv");
	 videoFrame.style.display = "none";
}
// Initiates a connection with the targetted device and receives image frames
function startStream() {
	 // Adds event listeners for the close and maximize stream buttons and makes appropriate
	 // 	UI changes
	 var closeStreamButton = document.getElementById("closeStreamButton");
	 closeStreamButton.addEventListener("click",closeStreamHandler);
	 closeStreamButton.style.display = "inline";
	 var maximizeStreamButton = document.getElementById("maximizeStreamButton");
	 maximizeStreamButton.addEventListener("click",maximizeStreamHandler);
	 maximizeStreamButton.style.display = "inline";
	 // Stores a reference to the canvas and makes it visible
	 var canvas = document.getElementById("streamCanvas");
	 canvas.style.display = "block";
	 // Sets an interval for looping through available image frames.
	 // 	This interval is set to call the streamIntervalListener function
	 // 	slightly under 15 times per second
	 streamInterval = setInterval(function(){
		  streamIntervalListener();
	 },500);
}
//  Updates the canvas with new image frame imagedata. Takes the canvas's 2d context
// 	and the interval's counter as parameters. The counter parameter can be removed once
// 	this function is no longer using static 1-20 frames.
//  This is where a call to the native function that returns
//  	the latest image frame's RGBA data array will go.
var streamImage = new Image();
function streamIntervalListener() {
	 var canvas = document.getElementById("streamCanvas");
	 canvas.width = canvas.parentNode.clientWidth;
	 canvas.height = canvas.parentNode.clientHeight;
	 var context = canvas.getContext('2d');
	 context.clearRect(0, 0, canvas.width, canvas.height);
	 // NEW: Image scaling fixed for images with greater height than width
	 streamImage.onload = function() {
		  imageNaturalWidth = streamImage.naturalWidth;
		  imageNaturalHeight = streamImage.naturalHeight;
		  var widthRatio = canvas.width / streamImage.naturalWidth;
		  var heightRatio = canvas.height / streamImage.naturalHeight;
		  var aspectRatio = streamImage.naturalWidth / streamImage.naturalHeight;
		  if(canvas.parentNode.getAttribute("maximized") == "yes") {
				if(heightRatio < widthRatio) {
					 var imageWidth = streamImage.naturalWidth * heightRatio;
					 var imageX = (canvas.width - imageWidth) / 2;
					 var imageY = 0;
					 context.drawImage(this, imageX, imageY, imageWidth, canvas.height);
				} else if (widthRatio < heightRatio) {
					 var imageHeight = streamImage.naturalHeight * widthRatio;
					 var imageX = 0;
					 var imageY = (canvas.height - imageHeight) / 2;
					 context.drawImage(this, imageX, imageY, canvas.width, imageHeight);
				} else {
					 context.drawImage(this, 0, 0, canvas.width, canvas.height);
				}
		  } else {
				if((streamImage.naturalWidth > canvas.width) && (heightRatio > widthRatio) ) {
					 var scalingRatio = canvas.width / streamImage.naturalWidth;
					 var imageHeight = streamImage.naturalHeight * scalingRatio;
					 var imageX = 0;
					 var imageY = (canvas.height - imageHeight) / 2;
					 context.drawImage(this, imageX, imageY, canvas.width, imageHeight);
				} else if(streamImage.naturalHeight > canvas.height) {
					 var scalingRatio = canvas.height / streamImage.naturalHeight;
					 var imageWidth = streamImage.naturalWidth * scalingRatio;
					 var imageX = (canvas.width - imageWidth) / 2;
					 var imageY = 0;
					 context.drawImage(this, imageX, imageY, imageWidth, canvas.height);
				} else {
					 var imageX = (canvas.width - streamImage.naturalWidth) / 2;
					 var imageY = (canvas.height - streamImage.naturalHeight) / 2;
					 context.drawImage(this, imageX, imageY, streamImage.naturalWidth, streamImage.naturalHeight);
				}
		  }
		  streamImage.onLoad = null;
		  streamImage.src = null;
		  delete window.streamImage;
		  /*canvas.width = streamImage.naturalWidth;
		  canvas.height = streamImage.naturalHeight;
		  context.drawImage(this, 0, 0, streamImage.naturalWidth, streamImage.naturalHeight);*/
	 }
	 // Loops through static image frames.
	 // streamImage.src should be set to the native function that returns imagedata
	 // 	for the latest image frame. I will also need to add the putImageData method to
	 // 	apply rgba data.
	 if(intervalCtr > 1) {
		  intervalCtr = 0;
	 }
	 if(intervalCtr == 0) {
		  streamImage.src = "bacon-eggs-1600-1200.jpg";
	 } else if(intervalCtr == 1) {
		  streamImage.src = "ribeye2-1200-800.jpg";
	 }
	 intervalCtr++;
}
var intervalCtr = 0;
// Stops the active stream. Takes no parameters and returns nothing.
function stopStream() {
	 // Clears the stream interval to free up memory.
	 clearInterval(streamInterval);
	 // Stores an array of references to the tabs' images
	 var tabImgs = document.getElementsByClassName("tabImg");
	 // Loops through the tab images and updates them to display the "off" graphic
	 for( var i = 0; i < tabImgs.length; i++ ) {
		  tabImgs[i].parentNode.childNodes[1].setAttribute("src","img/assets/bubble-off.png");
	 }
}
// Closes the active stream. A call to the native function that closes an active connection/stream should be
// 	added here.
function closeStream() {
	 stopStream();
	 var videoFrame = document.getElementById("streamDiv");
	 videoFrame.setAttribute("currentStream","no");
	 var streamHeader = document.getElementById("streamHeaderDiv").childNodes[1];
	 streamHeader.childNodes[0].nodeValue = "Open a tab and hit 'Connect' to initiate screen sharing!";
	 // Sets the canvas's frame Div styling back to its default values
	 if( videoFrame.getAttribute("maximized") == "yes") {
		  videoFrame.setAttribute("maximized", "no");
		  videoFrame.style.position = "relative";
		  videoFrame.style.float = "none";
		  videoFrame.style.width = "80%";
		  videoFrame.style.height = "720px";
		  videoFrame.style.margin = "1% auto 1% auto";
		  videoFrame.style.zIndex = "1";
	 }
	 // Places a clear rectangle over the canvas to hide old image frames
	 var canvas = document.getElementById("streamCanvas");
	 canvas.width = 800;
	 canvas.height = 600;
	 var ctx = canvas.getContext('2d');
	 ctx.clearRect(0,0,canvas.width,canvas.height);
	 // Removes event handlers for the stream control buttons
	 removeStreamEventHandlers();
	 // Sets the tabs' "streaming" attribute
	 var tabs = document.getElementsByClassName("screenTab");
	 for( var i = 0; i < tabs.length; i++ ) {
		  tabs[i].setAttribute( "streaming","no" );
	 }
}
// Removes the event handlers for maximizing and closing a stream to free up memory.
// 	Also hides the appropriate buttons.
function removeStreamEventHandlers() {
	 var maximizeStreamButton = document.getElementById("maximizeStreamButton");
	 maximizeStreamButton.style.display = "none";
	 maximizeStreamButton.removeEventListener("click",maximizeStreamHandler);
	 var closeStreamButton = document.getElementById("closeStreamButton");
	 closeStreamButton.style.display = "none";
	 closeStreamButton.removeEventListener("click",closeStreamHandler);
}
// Maximizes/minimizes the canvas's frame Div. This will need code for handling imageData scaling
function maximizeStream() {
	 var videoFrame = document.getElementById("streamDiv");
	 var isMaximized = videoFrame.getAttribute("maximized");
	 var canvas = document.getElementById("streamCanvas");
	 if( isMaximized == "no") {
		  /*videoFrame.setAttribute("maximized", "yes");
		  videoFrame.style.position = "absolute";
		  videoFrame.style.float = "left";
		  videoFrame.style.width = "100%";
		  videoFrame.style.height = "100%";
		  videoFrame.style.top = 0;
		  videoFrame.style.left = 0;
		  videoFrame.style.bottom = 0;
		  videoFrame.style.right = 0;
		  videoFrame.style.margin = "0 0px";
		  videoFrame.style.zIndex = "5";*/
		  canvas.width = window.innerWidth;
		  canvas.height = window.innerHeight;
	 } else if(isMaximized == "yes") {
		  /*videoFrame.setAttribute("maximized", "no");
		  videoFrame.style.position = "relative";
		  videoFrame.style.float = "none";
		  videoFrame.style.width = "80%";
		  videoFrame.style.height = "720px";
		  videoFrame.style.margin = "1% auto 1% auto";
		  videoFrame.style.zIndex = "0";
		  canvas.width = 800;
		  canvas.height = 600;*/
	 }
}