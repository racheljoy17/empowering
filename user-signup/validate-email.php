<?php

// Establish database connection
$mysqli = require __DIR__ . "/../database/EmpHomesdatabase.php";

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["email"])) {
    
    // Retrieve email from GET data
    $email = $_GET["email"];
    
    // Prepare SQL statement using prepared statement to prevent SQL injection
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    
    // Get result
    $result = $stmt->get_result();
    
    // Check if the email is already registered
    $available = $result->num_rows === 0;
    
    // Close prepared statement
    $stmt->close();
    
    // Return response as JSON
    header("Content-Type: application/json");
    echo json_encode(["available" => $available]);
}

// Close database connection
$mysqli->close();

?>
