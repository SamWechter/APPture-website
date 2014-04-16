function accountDetailsInit() {
	 document.getElementById("editDetailsBtn").addEventListener("click",makeDetailsEditable);
	 document.getElementById("countdownBtn").addEventListener("click",function() {window.location = "countdown.php"});
}

function makeDetailsEditable() {
	 // Enable first name input
	 document.getElementById("fNameField").disabled = false;
	 // Enable last name input
	 document.getElementById("lNameField").disabled = false;
	 // Enable organization input
	 document.getElementById("organizationField").disabled = false;
	 // Enable email address input
	 document.getElementById("emailField").disabled = false;
	 // Enable [re-enter current password] input
	 document.getElementById("oldPasswordField").disabled = false;
	 // Enable [enter new password] input
	 document.getElementById("newPasswordField").disabled = false;
	 // Enable [confirm new password] input
	 document.getElementById("newPasswordConfirmField").disabled = false;
	 // Enable [submit changes] button
	 document.getElementById("detailsSubmit").disabled = false;
}