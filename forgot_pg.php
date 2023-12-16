<!DOCTYPE html>
<!-- 
       Change Password Webpage
        By: Sebastian Skubisz
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        /* Styles for body, background, and container */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #2980b9, #6dd5fa);
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            color: #fff;
        }

        /* Styles for navigation */
        nav {
            background-color: #000;
            width: 100%;
            padding: 15px 0;
            text-align: center;
            position: absolute;
            top: 0;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
            margin: 0 10px;
            border: 1px solid transparent;
        }

        nav a:hover {
            background-color: #fff;
            color: #000;
        }

        nav a.active {
            background-color: #f1c40f;
            color: #333;
        }

        /* Styles for the logo */
        .logo-container {
            text-align: center;
            margin-bottom: 5px; /* Increased margin to create more space */
            margin-top: 55px; /* Adjusted margin-top to provide space below the navbar */
        }

        .logo-container img {
            max-width: 100%;
            height: auto;
        }

        /* Styles for the forgot password container */
        .forgot-password-container {
            width: 90%;
            max-width: 400px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            text-align: center;
            margin-top: 10px;
            margin-bottom: 10px; /* Adding margin at the bottom */
        }

        .forgot-password-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .forgot-password-container form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .forgot-password-container input[type="text"],
        .forgot-password-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #f4f4f4;
            color: #333;
            box-sizing: border-box;
        }

        .forgot-password-container input[type="submit"] {
            width: 50%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #2980b9;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .forgot-password-container input[type="submit"]:hover {
            background-color: #0077aa;
        }

        /* Error message style */
        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <a href="/login_pg.php">Login</a>
        <a href="/register_pg.php">Register</a>
    </nav>

    <!-- Logo -->
    <div class="logo-container">
        <img src="logo.png" alt="Logo Image">
    </div>

    <!-- Forgot Password container -->
    <div class="forgot-password-container">
        <h2>Forgot Password</h2>
        <form method="POST" action="forgot.php" id="forgotPasswordForm">
            <input type='text' id='username' name='username' placeholder="Username" aria-label="Username" required>
            <input type='text' id='securityWord' name='securityWord' placeholder="Security Word" aria-label="Security Word" required>
            <input type='text' id='securityPin' name='securityPin' placeholder="Security PIN" aria-label="Security PIN" required>
            <input type='password' id='newPassword' name='newPassword' placeholder="New Password" aria-label="New Password" required>
            <input type='password' id='confirmNewPassword' name='confirmNewPassword' placeholder="Confirm New Password" aria-label="Confirm New Password" required>
            <input type='submit' value="Reset Password">
            <p class="error-message" id="errorMessage"></p>
        </form>
    </div>
</body>
</html>
