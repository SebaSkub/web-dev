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
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            color: #fff;
        }

        nav {
            background-color: #333;
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
        }

        nav a:hover {
            background-color: #555;
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
        <a href="/login_pg.php" class="active">Login</a>
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
