<?php
// submit_favorite.php

// Allow CORS and tell the client we’re returning JSON
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Database credentials
$servername = "3.84.60.238:3306";
$username   = "redzone";
$password   = "Redzone123!";
$dbname     = "redzone";

// Connect
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "error"   => "Connection failed: " . $conn->connect_error
    ]);
    exit;
}

// Make sure we're handling a POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        "success" => false,
        "error"   => "Invalid request method"
    ]);
    $conn->close();
    exit;
}

// Retrieve and sanitize form inputs
$name            = trim($_POST['name']            ?? '');
$location        = trim($_POST['location']        ?? '');
$favorite_team   = trim($_POST['favorite_team']   ?? '');
$favorite_player = trim($_POST['favorite_player'] ?? '');

// Validate required fields
if (!$name || !$location || !$favorite_team || !$favorite_player) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "error"   => "All fields (name, location, favorite_team, favorite_player) are required."
    ]);
    $conn->close();
    exit;
}

// Prepare and execute INSERT into your preferences table
// (Make sure you have a table named `user_preferences` with matching columns)
$stmt = $conn->prepare("
    INSERT INTO user_preferences 
        (name, location, favorite_team, favorite_player) 
    VALUES (?, ?, ?, ?)
");
$stmt->bind_param("ssss", $name, $location, $favorite_team, $favorite_player);

if ($stmt->execute()) {
    echo json_encode([
        "success"   => true,
        "insert_id" => $stmt->insert_id
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "error"   => $stmt->error
    ]);
}

$stmt->close();
$conn->close();
?>
