<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
            color: #fff;
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

        /* Styles for login form */
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

        /* Styles for "Register Here" button */
        .register-btn {
            width: 50%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #27ae60;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        .register-btn:hover {
            background-color: #218e53;
        }

        /* Styles for error messages */
        .error-message {
            color: red;
            margin-top: 10px;
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
            border: 1px solid #fff; /* Changed border color to white */
        }

        nav a:hover {
            background-color: #fff; /* Changed hover background color to white */
            color: #000; /* Changed hover text color to black */
        }

        nav a.active {
            background-color: #f1c40f;
            color: #333;
        }

        .content {
            max-width: 800px;
            text-align: center;
            padding: 20px;
        }

        h1 {
            margin-top: 50px;
        }

        p {
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .lol-image {
            max-width: 100%;
            height: auto;
            margin-top: 30px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <nav>
        <a href="/login_pg.php">Login</a>
        <a href="/register_pg.php">Register</a>
    </nav>

    <div class="content">
        <h1>Explore and Compare Your League of Legends Stats</h1>
        <p>
            Welcome to our League of Legends community! Discover a platform where you can dive deep into your in-game statistics and compare your performance with top players worldwide.
        </p>
        <p>
            Our website offers an intuitive way to access your match history, analyze your champion performance, and track your progress. Whether you're a seasoned player or just starting your journey in LoL, our tools help you understand and improve your gameplay.
        </p>
        <p>
            Join us to explore your strengths, identify areas for improvement, and compete with the best. Elevate your League of Legends experience with our comprehensive stat analysis and player comparison features.
        </p>
        <img class="lol-image" src="download.jpeg" alt="League of Legends Image" />
    </div>
</body>
</html>
