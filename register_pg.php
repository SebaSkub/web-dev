<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        /* Your CSS styles here */
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
        
          .navbar {
            background-color: #000;
            width: 100%;
            text-align: center;
        }

        .navbar-links {
            display: flex;
            justify-content: center;
            padding: 15px 0;
            list-style-type: none;
            margin: 0;
        }

        .navbar-links li {
            margin: 0 10px;
        }

        .navbar-links a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .navbar-links a:hover {
            background-color: #fff;
            color: #000;
        }

        .navbar-links a.active {
            background-color: #f1c40f;
            color: #333;
        }

        .registration-container {
            width: 90%;
            max-width: 400px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 30px;
            text-align: center;
            margin-top: 50px;
        }

        .registration-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .registration-container form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .registration-container input[type="text"],
        .registration-container input[type="email"],
        .registration-container input[type="password"],
        .registration-container input[type="date"],
        .registration-container input[type="number"],
        .registration-container input[type="url"],
        .registration-container input[type="submit"] {
            width: calc(100% - 24px);
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #007bff;
            border-radius: 5px;
            background: #f4f4f4;
            color: #333;
            box-sizing: border-box;
        }

        .registration-container input[type="submit"] {
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
            transition: background-color 0.3s;
        }

        .registration-container input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .registration-container a {
            text-decoration: none;
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            background: #fff;
            padding: 10px;
            border-radius: 5px;
            width: 50%;
            margin-left: auto;
            margin-right: auto;
        }

        .registration-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <nav>
        <a href="/login_pg.php">Login</a>
        <a href="/home_pg.php">Home</a>
    </nav>

    <div class="registration-container">
        <h2>User Registration</h2>
        <form id="registrationForm" action="register.php" method="POST">
            <!-- Input fields -->
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="text" id="firstName" name="firstName" placeholder="First Name" required>
            <input type="text" id="lastName" name="lastName" placeholder="Last Name" required>
            <input type="date" id="dob" name="dob" required>
            <input type="number" id="age" name="age" placeholder="Age" required>
            <input type="text" id="lolId" name="lolId" placeholder="League of Legends ID" required>
            <input type="url" id="steamLink" name="steamLink" placeholder="Steam Link" required>
            <input type="text" id="securityQuestion1" name="securityQuestion1" placeholder="Security Question #1: (Random Word)" required>
            <div class="top">
                <input type="text" id="securityQuestion2" name="securityQuestion2" placeholder="Security Question #2: (Random PIN)" readonly>
                <button type="button" id="generatePIN">Generate PIN</button>
            </div>
            <h3>Login Information</h3>
            <input type="text" id="username" name="username" placeholder="Username" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <input type="submit" value="Register">
        </form>
        <a href="/login_pg.php">Back to Login</a>
    </div>

    <script>
        document.getElementById('generatePIN').addEventListener('click', function() {
            const securityQuestion2Input = document.getElementById('securityQuestion2');
            const randomPin = generateRandomPin();
            securityQuestion2Input.value = randomPin;
        });

        function generateRandomPin() {
            return Math.floor(1000 + Math.random() * 9000).toString();
        }
    </script>
</body>
</html>
