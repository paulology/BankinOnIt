<?php
/*
	This script attempts to connect to the database BANKIN and SELECT data associated with the tblMerchant table
	If the connection is successful and data is found, the script will echo the data in jSON format
	In all other cases, the script will echo "false"
	If data is echoed here, the Android app will present the data 
	If "false" is echoed here, the Android app will alert the user of an error
*/

//connect to database 
try {
	require "connect.php";	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} else {
		//query get account info
		$sql = "SELECT * FROM tblMerchant";
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
