<?php
	 header("Access-Control-Allow-Origin: *");
	 require_once('LIB_Appture.php');
	 
	 $response_json = '{ "response": ';
	 
	 $mysqli = get_connection();
	 $currentHighestBetaPos = get_current_highest_beta_queue_pos( $mysqli );
	 
	 if($currentHighestBetaPos >= 0) {
		  $response_json .= '"' . ( $currentHighestBetaPos + 1) . '" }';
		  echo $response_json;
	 } else {
		  $response_json .= '"error" }';
		  echo $response_json;
	 }
	 
?>