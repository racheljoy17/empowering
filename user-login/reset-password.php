<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ ."/../database/EmpHomesdatabase.php";

$sql = "SELECT * FROM users
        WHERE reset_token_hash = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null){
    die("Token not Found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()){
    die("Token has Expired");
};

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
    <title>Reset Password - Empowering Homes</title>
    <style>
        
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: beige;
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
            border-radius: 10px;
            overflow: hidden;
            width: 100%;
            max-width: 280px;
            background-color: white;
            padding: 7px;
    
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            max-width: 800px;
            margin: 0 auto;
            background-color: #fbb622;
            border-radius: 10px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        .logo {
            flex: 1;
            text-align: center;
        }

        .logo img {
            max-width: 250px;
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
            color:  orange;
        }

        .two-forms {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .two-forms .input-box:first-child {
            margin-right: 10px; /* Add margin-bottom to create space between the two textboxes */
            margin-bottom: 2px;
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
            border-color:  rgb(202, 201, 201);
        }

        .input-box i {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 15px;
            color: darkgoldenrod;
            font-size: 18px;
        }

        button {
            font-size: 18px;
            font-weight: 500;
            height: 45px;
            width: 100%;
            background-color: orange;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
        }

        button:hover {
            background: darkkhaki;
            box-shadow: 1px 5px 7px 1px rgba(0, 0, 0, 0.2);
        }

        .two-col {
            display: flex;
            justify-content: space-between;
        }

        label {
            color: black;
        }

        a {
            text-decoration: none;
            color: #3498db;
        }

        .two-forms #icon {
            position: absolute;

            color: orange;
            font-size: 18px;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
        }

        .input-box #iconlock {
            position: absolute;

            color: orange;
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
            color: orange;
            cursor: pointer;
        }

        #password-toggle {
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: orange;
        }

        #confirmpassword-toggle {
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: orange;
        }


        .error {
            text-align: left;
            font-size: 12px;
            color: red;
            margin-left: 10px;
        }

        @media only screen and (max-width: 600px) {
            .form-box {
                border-radius: 20px;
                padding: 7px;
            }
        }
    </style>

</head>

<body>
<div class="container">
        <div class="logo">
            <img src="../images/e-logo-vertical.png" alt="Your Logo">
        </div>
    <div class="form-box">
        <div class="register-container" id="register">
            <div class="top">
               
                <header>Reset Password</header>
            </div>
            <form method="post" action="../database/process-reset-password.php">
            <div class="input-box">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                <i class="fas fa-lock" id="iconlock"></i>
                <input type="password" class="input-field" name="password" id="passwordField" placeholder="Password" oninput="validatePassword(this)">
                <div class="error" id="passwordError"></div>
                <i id="password-toggle" class="fas fa-eye" onclick="togglePassword('passwordField')"></i>
            </div>
            <div class="input-box">
                <i class="fas fa-lock" id="iconlock"></i>
                <input type="password" class="input-field" name="password_confirmation" id="confirmpasswordField" placeholder="Confirm Password" oninput="validateConfirmPassword(this)">
                <i id="confirmpassword-toggle" class="fas fa-eye" onclick="togglePassword('confirmpasswordField')"></i>
                <div class="error" id="confirmPasswordError"></div>
            </div>

                <button>Send</button>

            </form>
        </div>

    </div>
    </form>

    <script>
        function validatePassword(input) {
            var errorElement = document.getElementById("passwordError");
            if (input.value.length < 8 || !/[!@#$%^&*(),.?":{}|<>_]/.test(input.value)) {
                errorElement.textContent = "Password must have 8 characters and contain special characters";
            } else {
                errorElement.textContent = "";
            }
        }

        function validateConfirmPassword(input) {
            var errorElement = document.getElementById("confirmPasswordError");
            var passwordInput = document.getElementById('passwordField'); // Corrected reference to the password input

            if (input.value !== passwordInput.value) {
                errorElement.textContent = "Passwords do not match";
            } else {
                errorElement.textContent = "";
            }
        }

        function togglePassword(fieldId) {
            var passwordField = document.getElementById(fieldId);
            var passwordToggle = document.getElementById(fieldId + "-toggle");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                passwordToggle.className = "fas fa-eye-slash"; // Change to an eye-slash icon when showing password
            } else {
                passwordField.type = "password";
                passwordToggle.className = "fas fa-eye"; // Change back to an eye icon when hiding password
            }
        }
</script>
</body>

</html>
