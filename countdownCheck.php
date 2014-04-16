<?php
	 header("Access-Control-Allow-Origin: *");
	 require_once('LIB_Appture.php');
	 
	 $response_json = '{ "response": ';
	 
	 $uEmail = $_POST["countdownEmail"];
	 
	 if(strlen($uEmail) > 0) {
		  $mysqli = get_connection();
		  $uid = get_user_id( $mysqli, $uEmail );
		  $currentBetaPos = get_current_beta_queue_pos( $mysqli, $uid ) + 1;
		  //echo $currentBetaPos;
		  $response_json .= '"' . $currentBetaPos . '" }';
		  echo $response_json;
	 } else {
		  $response_json .= '"error" }';
		  echo $response_json;
	 }
	 
?>