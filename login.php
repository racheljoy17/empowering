<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
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
        .loginbox{
            background-color: transparent;
            width: 400px;
            backdrop-filter: blur(30px);
            height:fit-content;
            margin: 20px auto;
            display: block;
            padding: 50px 20px;
            justify-content: center;
            border: 2px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: center;
        }
        input[type="email"], input[type="password"] {
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

        input[type="password"]::placeholder {
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
        .forgot{
            margin: 20px 0 20px 0;
        }
        .forgot:hover{
            color: aqua;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="." class="logo">Guardian</a>
        <div class="header-right">
            <a href="">Home</a>
            <a href="">About</a>
            <a href="">Who we Are</a>
        </div>
    </div>
    <div class="container mt-5">
        <div class="loginbox">
            
        <h1>Login</h1>
            <form method="post">
                <input type="email" name="email" id="email"
                    value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" placeholder="Enter Email">
                <br>
                <input type="password" name="password" id="password" placeholder="Enter Password">
                <br>
                <?php if ($is_invalid): ?>
                <div class="error" style="color:red;">
                    Please enter a correct Email and Password
                </div>
                <?php endif; ?>
                <button>Log in</button>
            </form>
            <div class="forgot">
                <a href="forgot-password.php" style="color: white; margin: 20px 0 20px 0">Forgot password?</a>
            </div>
            <div class="signup">
                <a href="signup.html" style="color: white">Sign Up</a>
            </div>
        </div>
    </div>
</body>
</html>
