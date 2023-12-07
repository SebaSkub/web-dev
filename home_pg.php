<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        /* Your CSS styles here */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #fff;
            background: url('image1.jpeg') no-repeat center center fixed; /* Set the initial background */
            background-size: cover;
            transition: opacity 1s ease-in-out;
        }

        nav {
            background-color: #000;
            width: 100%;
            padding: 15px 0;
            text-align: center;
            position: fixed;
            top: 0;
            z-index: 999;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
            margin: 0 10px;
            border: 1px solid #fff;
        }

        nav a:hover {
            background-color: #fff;
            color: #000;
        }

        .content {
            max-width: 800px;
            text-align: center;
            padding: 20px;
            margin-top: 60px;
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

    <script>
        const images = ['image1.jpeg', 'image2.jpeg', 'image3.jpeg', 'image4.jpeg', 'image5.jpeg'];
        let currentImageIndex = 0;
        const body = document.body;

        function changeBackground() {
            body.style.opacity = '0'; // Fade out
            setTimeout(() => {
                body.style.backgroundImage = `url(${images[currentImageIndex]})`;
                currentImageIndex = (currentImageIndex + 1) % images.length;
                body.style.opacity = '1'; // Fade in
            }, 1000); // Change image after 1 second (when fully faded out)
        }

        setInterval(changeBackground, 5000); // Change image every 5 seconds
    </script>
</body>
</html>
