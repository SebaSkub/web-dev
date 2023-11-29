<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #2980b9, #6dd5fa);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-container {
            width: 90%;
            max-width: 400px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 30px;
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .login-container form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #f4f4f4;
            color: #333;
            box-sizing: border-box;
        }

        .login-container input[type="submit"] {
            width: 50%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #2980b9;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-container input[type="submit"]:hover {
            background-color: #0077aa;
        }

        nav {
            text-align: center;
            margin-top: 20px;
        }

        nav a {
            margin: 0 10px;
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body>
     <nav>
        <a href="/home_pg.php">Home</a>
        <a href="/register_pg.php">Register</a>
    </nav>
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="login.php" id="loginForm">
            <input type='text' id='username' name='username' placeholder="Username" required>
            <input type='password' id='password' name='password' placeholder="Password" required>
            <input type='submit' value="Login">
        </form>
        
    </div>
</body>
</html>
