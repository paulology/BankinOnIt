<?php
/*
	This script attempts to connect to the database BANKIN and SELECT the UserID associated with the user's account
	If the connection is successful and a UserID is found, the script will echo the UserId in jSON format
	In all other cases, the script will echo "false"
	If UserId is echoed here, the Android app will allow login and access to account information
	If "false" is echoed here, the Android app will not login, but display an error message
*/

//connect to database 
try {
	require "connect.php";	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} else {

		//Username and Password entered in android
		$username = $_POST['username'];
		$password = $_POST['password'];
		//query get UserID
		$sql = "SELECT UserId FROM tblUser";
		$sql .= " WHERE Username = '$username' AND Password = '$password'";
		//put result in array
		$result = mysqli_query($conn, $sql) or die("Error in selecting: ". mysqli_error($conn));
		$resarray = array();
		//if results found
		if(mysqli_num_rows($result) > 0) {
			echo "connect";
			mysqli_close($conn);
		//if results not found
		} else {
			echo "invalid";
		}
	}
} catch (Exceptoin $e) {
	//if anything in the try fails
	echo "fail";
}
?>
