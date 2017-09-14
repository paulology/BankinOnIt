<?php
/*
	This script attempts to connect to the database BANKIN and SELECT data associated with the user's transactions
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

		//for testing:
		//$transId = 555;
		//$accountId = 1;

		$transId = $_POST['inputOne'];

		//select last transId inserted into table
		$sql = "DELETE FROM tblTransaction";
		$sql .= " WHERE TransId = '$transId'";
		//set result variables
		$delete = mysqli_query($conn, $sql) or die("Error in selecting ". mysqli_error($conn));
		echo "deleted";
		/*
		//for testing
		$sql = "SELECT * FROM tblTransaction";
		$sql .= " WHERE AccountId = '$accountId'";
		$sql .= " ORDER BY TransId DESC LIMIT 0,1";
		
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
		*/
	}
//send error if try fails
} catch (Exceptoin $e) {
	//for testing:
	//echo $e;	
	echo "fail";
}
?>
