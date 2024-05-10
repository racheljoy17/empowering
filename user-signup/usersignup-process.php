<?php

$userid = rand(10000000,99999999);

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/../database/EmpHomesDatabase.php";

// Check if the email already exists in the database
//$checkSql = "SELECT email FROM users WHERE email = ?";
//$checkStmt = $mysqli->prepare($checkSql);
//$checkStmt->bind_param("s", $_POST["email"]);
//$checkStmt->execute();
//$checkStmt->store_result();

//if ($checkStmt->num_rows > 0) {
//    die("Email is already taken");
//}


$sql = "INSERT INTO users (userid, firstname, middlename, lastname, email, password_hash)
        VALUES (?, ?, ?, ?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssssss",
                    $userid,
                    $_POST["firstname"],
                    $_POST["middlename"],
                    $_POST["lastname"],
                    $_POST["email"],
                    $password_hash);
                  
if ($stmt->execute()) {
    header("Location: ../user-login/login.php");
    exit;
}

?>