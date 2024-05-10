<?php

$email = $_POST["email"];

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() +60 * 30);

$mysql =  require __DIR__ ."/database.php";

$sql = "UPDATE user
        SET reset_token_hash = ?,
            reset_token_expires_at = ?
        WHERE email = ?";

$stmt = $mysql->prepare($sql);

$stmt->bind_param("sss", $token_hash, $expiry, $email);

$stmt->execute();

if ($stmt->affected_rows) {
    
    $mail = require __DIR__ ."/mailer.php";

    $mail->setFrom("ibadriano15@gmail.com");
    $mail->addAddress($email);
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END

    Click <a href="http://localhost/adriano-contalba/reset-password.php?token=$token">here</a> to reset your password.
    If you recieved this mail without your knowledge, please disregard this message. Thank you  

    END;

    try {

        $mail->send();

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <style>
        body{
            background-image: url(HomeWallpaper.jpg);
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            justify-content: flex-end;
            height: 100vh;
        }
        .header {
            overflow: hidden;
            background-color: #f1f1f1;
            padding: 5px 10px;
            font-size: 20px;
        }
        .header a.logo {
            font-size: 25px;
            font-weight: bold;
        }
        .header a {
            float: left;
            text-align: center;
            padding: 12px;
            text-decoration: none;
            font-size: 18px; 
            line-height: 25px;
            border-radius: 4px;
        }
        .header-right {
            float: right;
        }
        h1{
            text-align: center;
        }
        .forgotbox{
            background-color: transparent;
            width: 400px;
            backdrop-filter: blur(30px);
            height:fit-content;
            display: block;
            margin: 20px auto;
            padding: 50px 20px;
            justify-content: center;
            border: 2px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: center;
        }
        input[type="email"] {
            width: 100%;
            padding: 10px 20px;
            border-radius: 20px;
            border: none;
            margin: 20px 0;
            outline: none;
            background-color: transparent;
            border: 2px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            color: white;
        }
        input[type="email"]::placeholder {
            padding: 0 10px;
            color: white;
        }

        h1 {
            color: white;
            font-size: 30px;
            margin: 10px;
            text-align: center;
        }
        button{
            background-color: pink;
            display: block;
            width: 100%;
            border: none;
            padding: 10px;
            border-radius: 30px;
            margin: 20px 0;
            text-decoration: none;
            color:white;
            transition: 1s;
            text-align: center;
        }
        button:hover {
            background-color: lightblue;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="." class="logo">Guardian</a>
        <div class="header-right">
            <a href="">About</a>
            <a href="">Who we Are</a>
        </div>
    </div>
    <div class="forgotbox">
        <h1>Email Sent!</h1>
        <p style="color: white;">Please check your inbox to reset your password.</p>
        <a href="login.php">Back</a>
    </div>
</body>
</html>