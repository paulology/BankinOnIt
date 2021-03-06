<?php
/*
	This script attempts to connect to the database BANKIN and SELECT data associated with the user's account
	If the connection is successful and a data is found, the script will echo the data in jSON format
	In all other cases, the script will echo "false"
	If data is echoed here, the Android app will allow present the data
	If "false" is echoed here, the Android app will alert the user of an error
*/

//connect to database 
try {
	require "connect.php";	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} else {
		//username and password entered in android
		$username = $_POST['username'];
		$password = $_POST['password'];
		$stars = "************";
		//query get account info
		$sql = "SELECT AccountId, UserId, AccountNum,";
		$sql .= " CONCAT('$stars', SUBSTRING(AccountNum,13)) AccountNumSecure,";
		$sql .= " CCV, Credit";
		$sql .= " FROM tblAccount WHERE UserId =";
		$sql .= " (SELECT UserId FROM tblUser";
		$sql .= " WHERE Username = '$username'";
		$sql .= " AND Password = '$password')";

		//following two lines for testing
		//$sql .= " WHERE Username = 'rschwadron'";
		//$sql .= " AND Password = 'nordawhcsr')";
		
		//put result in array
		$result = mysqli_query($conn, $sql) or die("Error in selecting ". mysqli_error($conn));
		$resarray = array();
		
		//if results found
		if(mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$resarray[] = $row;
			}
			echo json_encode($resarray);
			mysqli_close($conn);
		//if results not found
		} else {
			echo "fail";
		}
	}
//send error if try fails
} catch (Exceptoin $e) {
	//for testing:
	//echo $e;	
	echo "fail";
}
?>
