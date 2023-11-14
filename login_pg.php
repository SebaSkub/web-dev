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
            height: 100vh;
        }

        .login-container {
            max-width: 400px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .error-box {
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            background-color: #ff6961;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            z-index: 9999;
        }

        h2 {
            color: #333;
        }

        form {
            padding: 20px;
        }

        table {
            width: 100%;
        }

        td {
            padding: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
            background: #f4f4f4;
            color: #333;
        }

        input[type="submit"] {
            background-color: #2980b9;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 10px 15px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0077aa;
        }

        a {
            text-decoration: none;
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #2980b9;
        }

        a:hover {
            text-decoration: underline;
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
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="login.php" id="loginForm">
            <table>
                <tr>
                    <td>Username:</td>
                    <td><input type='text' id='username' name='username' required></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type='password' id='password' name='password' required></td>
                </tr>
            </table>
            <br>
            <input type='submit' value="Login"><br><br>
        </form>
        <br>
    </div>

    <nav>
        <a href="/landing.php">Landing</a>
        <a href="/register_pg.php">New User?&ensp;Register here!</a>
        <a href="/login.php">Login</a>
    </nav>
</body>
</html>
