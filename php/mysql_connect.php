<?php
$servername = "localhost";
$username = "paul";
$password = "root";
$dbname = "BANKIN";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$username = $_REQUEST('userName');
$sql = "SELECT UserID, FirstName, LastName FROM tblUser where userName = '" . $userName . "'";
$result = mysqli_query($conn, $sql) or die("Error in selecting " . mysqli_error($conn));

$emparray = array();

while($row = mysqli_fetch_assoc($result)) {
	$emparray[] = $row;
}
echo json_encode($emparray);
mysqli_close($conn);














/*if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["UserID"]. " - Name: " . $row["FirstName"]. " " . $row["LastName"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();*/
?>
