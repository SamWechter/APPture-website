<?php
	 require_once('LIB_Appture.php');
	 
	 $uid = $_GET['uid'];
	 $newSqli = get_connection();
	 validateUser($newSqli, $uid);
	 /*$updateString = "UPDATE $tableName SET validated='1' WHERE user_id='$uid'";
	 $validationSqli->query($updateString);
	 $validationSqli->close();*/
	 echo "<h1>Your email address has been validated.</h1>\n";
	 echo "<a href='index.html'>Back to APPture home</a>";
	 
	 function validateUser($aSqli,$userID) {
		  $tableName = "users";
		  $query = "UPDATE $tableName SET validated=? WHERE id=?";
		  $values = array();
		  $values[] = 1;
		  $values[] = $userID;
		  $types = "ii";
		  $stmt = $aSqli->stmt_init();
		  if( $stmt->prepare( $query ) ) {
				$stmt->bind_param( $types, $values[0], $values[1] );
				$stmt->execute();
		  } else {
				echo "<h3>".$stmt->error."</h3>";
		  }
	 }
?>