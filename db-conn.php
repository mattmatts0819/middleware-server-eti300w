<?php
header("Access-Control-Allow-Origin: *");

$servername= "44.211.143.9:3306";
$username= "redzone";
$password= "Redzone123!";
$dbname= "redzone";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM teams";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  $data = [];
  while($row = $result->fetch_assoc()) {
	$data[] = $row;
	}
}
 else {
  echo "0 results";
}
header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>
