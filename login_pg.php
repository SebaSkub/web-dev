<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        nav {
            background-color: #000; /* Changed to black */
            width: 100%;
            padding: 15px 0;
            text-align: center;
            display: flex;
            justify-content: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
            margin: 0 10px;
            border: 1px solid transparent; /* Added border for better visibility */
        }

        nav a:hover {
            background-color: #fff;
            color: #000; /* Changed text color on hover */
        }

        nav a.active {
            background-color: #f1c40f;
            color: #333;
        }

        .login-container {
            width: 90%;
            max-width: 400px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 30px;
            text-align: center;
            margin-top: 20px; /* Added margin-top to align with the nav bar */
        }

        /* Rest of your styles... */
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <a href="/home_pg.php">Home</a>
        <a href="/register_pg.php">Register</a>
    </nav>

    <!-- Login container -->
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="login.php" id="loginForm">
            <input type='text' id='username' name='username' placeholder="Username" aria-label="Username" required>
            <input type='password' id='password' name='password' placeholder="Password" aria-label="Password" required>
            <input type='submit' value="Login">
            <button class="register-btn" onclick="location.href='/register_pg.php'">Register Here</button>
            <p class="error-message" id="errorMessage"></p>
        </form>
    </div>
</body>
</html>
