
<?php
// submit_favorite.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Allow CORS and return JSON
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Database credentials
$servername = "54.172.79.20:3306";
$username   = "redzone";
$password   = "Redzone123!";
$dbname     = "redzone";

// Connect
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("DB connect failed: " . $conn->connect_error);
}


// Read form inputs directly (no sanitization)
$name            = $_POST['name'];
$location        = $_POST['location'];
$favorite_team   = $_POST['favorite_team'];
$favorite_player = $_POST['favorite_player'];

// Build and execute the INSERT (vulnerable to SQL injection)
$sql = "INSERT INTO user_preferences (name, location, favorite_team, favorite_player)
        VALUES ('$name', '$location', '$favorite_team', '$favorite_player')";

if ($conn->query($sql)) {
    echo json_encode([
        "success"   => true,
        "insert_id" => $conn->insert_id
    ]);
} else {
    echo json_encode([
        "success" => false,
        "error"   => $conn->error
    ]);
}

$conn->close();
echo "Success!";
?>
