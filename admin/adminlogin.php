<?php

session_start();

if (isset($_SESSION["adminauth"])) {
    
    $mysqli = require __DIR__ . "/../database/EmpHomesDatabase.php";
    
    $sql = "SELECT * FROM admins
            WHERE adminauth = {$_SESSION["adminauth"]}";
            
    $result = $mysqli->query($sql);
    
    $admin = $result->fetch_assoc();
} else {
    header("Location: ../index.html");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/../database/EmpHomesdatabase.php";
    
    $sql = sprintf("SELECT * FROM adminlogin
                    WHERE adminid = '%d'",
                   $mysqli->real_escape_string($_POST["adminid"]));
    
    $result = $mysqli->query($sql);
    
    $admin = $result->fetch_assoc();
    
    if ($admin) {
        
        if ($_POST["password"] === $adminlogin["adminpassword"]) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["adminid"] = $adminlogin["adminid"];
            
            header("Location: admin-dashboard.html");
            exit;
        }
    }
    
    $is_invalid = true;
} 


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-fmPv08t9auC4Llm1LFOkAq7z4Y0IdP98h66sy2B4OG+eW+X8z5HTt3p8zY+mgk6r6Uc3lWYSrtBX4ptTG9DCQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;100;300;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Empowering Homes</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-image: linear-gradient(rgb(92, 92, 92), rgba(178, 178, 178, 0.616));
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-box {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            overflow: hidden;
            width: 100%;
            max-width: 400px;
            background-color: wheat;
            padding: 7px;

        }

        .register-container {
            padding: 20px;
            box-sizing: border-box;
        }

        .top {
            text-align: center;
            margin-bottom: 20px;
            color: black;
        }

        header {
            font-size: 35px;
            font-weight: 650;
            color: darkgoldenrod;
        }

        .two-forms {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .two-forms .input-box:first-child {
            margin-right: 10px;
            /* Add margin-bottom to create space between the two textboxes */
            margin-bottom: 15px;
        }

        .input-box {
            position: relative;
            margin-bottom: 20px;
            height: 40px;
        }

        .input-field {
            font-size: 15px;
            height: 100%;
            width: 100%;
            padding: 10px 10px 10px 40px;
            border: 2px solid #ccc;
            border-radius: 30px;
            box-sizing: border-box;
            border-color: darkgoldenrod;
        }

        .input-box .fa-user {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 10px;
            color: darkgoldenrod;
            font-size: 18px;
        }

        .submit {
            font-size: 18px;
            font-weight: 500;
            height: 45px;
            width: 100%;
            background-color: darkgoldenrod;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
        }

        .submit:hover {
            background: darkkhaki;
            box-shadow: 1px 5px 7px 1px rgba(0, 0, 0, 0.2);
        }

        .two-col {
            display: flex;
            justify-content: space-between;
        }

        label {
            color: rgb(1, 1, 1);
        }

        a {
            text-decoration: none;
            color: #3498db;
        }

        .two-forms #icon {
            position: absolute;
            color: darkgoldenrod;
            font-size: 18px;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
        }

        .input-box #iconlock {
            position: absolute;
            color: darkgoldenrod;
            font-size: 18px;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
        }

        #togglepassword,
        #passwordtoggle {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: darkgoldenrod;
            cursor: pointer;
        }

        #password-toggle {
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: darkgoldenrod;
        }

        #confirmpassword-toggle {
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: darkgoldenrod;
        }


        .error {
            text-align: left;
            font-size: 12px;
            color: red;
            margin-left: 10px;
            display: none; /* Initially hide the error message */
        }

        .error.active {
            display: block; /* Display error message for active (incorrect) input */
        }

        @media only screen and (max-width: 600px) {
            .form-box {
                border-radius: 20px;
                padding: 7px;
            }
        }

        .homebtn {
            display: flex;
            justify-content: center;
            margin: 25px 0 0 0;
            font-size: 20px;
        }
    </style>

</head>

<body>
    <div class="form-box">
        <div class="register-container" id="register">
            <div class="top">
                <header>Admin Login</header>
                <h4>If you are not authorized to login here, please go back to the main page!</h4>
            </div>
            <form action="admin_dashboard.html" method="post" id="usersignup" novalidate>
                <div class="input-box">
                    <i class="fas fa-user" id="iconuser"></i>
                    <input type="password" class="input-field" id="usernameField" name="adminid" placeholder="Enter Username">
                    <div class="error" id="usernameError">Incorrect username!</div>
                </div>
                <div class="input-box">
                    <i class="fas fa-lock" id="iconlock"></i>
                    <input type="password" class="input-field" id="passwordField" name="password" placeholder="Password">
                    <div class="error" id="passwordError">Incorrect password!</div>
                </div>
                <div class="input-box">
                    <button type="submit" class="submit" value="Sign In">Login</button>
                </div>
                <div class="homebtn">
                    <label><a href="index.html">Home</a></label>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById("usersignup").addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent the form from submitting

            // Get the values of the username and password fields
            var username = document.getElementById("usernameField").value;
            var password = document.getElementById("passwordField").value;

            // Check if the username and password are correct
            if (username === "admin" && password === "admin") {
                // Redirect to the admin dashboard if the credentials are correct
                window.location.href = "admin-dashboard.html";
            } else {
                // Display the error message only for the active (incorrect) input
                document.getElementById("usernameError").classList.toggle("active", username !== "admin");
                document.getElementById("passwordError").classList.toggle("active", password !== "admin");
            }
        });
    </script>
</body>

</html>
