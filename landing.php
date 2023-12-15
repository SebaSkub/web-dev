<?php
session_start(); // Start the session

// Check if the user is not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect the user to the login page
    header("Location: /login_pg.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>League of Legends Stats</title>
    <img src='logo.png' alt='Logo Image'>
   <style>
        /* Your CSS styling here */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #2980b9, #6dd5fa);
            margin: 0;
            padding: 0;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        img {
            margin-top: 60px;
            margin-bottom: 20px;
            max-width: 50%; /* Ensures the logo doesn't exceed its container */
        }

        nav {
            width: 100%;
            background-color: #000;
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

        h1 {
            text-align: center;
            margin-top: 20px; /* Adjusted margin top to create space below the navbar */
        }

        table {
            width: 95%; /* Adjusted width to avoid overflowing */
            max-width: 1200px;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow-x: auto;
        }

        th,
        td {
            border: 1px solid #fff;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #333;
        }

        tr:nth-child(even) {
            background-color: #444;
        }

        form {
            margin-top: 20px;
            display: flex;
            align-items: center;
        }

        input[type=text] {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }

        button[type=submit] {
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #f1c40f;
            color: #333;
            border: none;
            cursor: pointer;
        }

        .search-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .search-container input[type="text"] {
            padding: 10px;
            border-radius: 25px;
            border: none;
            outline: none;
            background: #fff;
            width: 300px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .search-container input[type="text"]:focus {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .search-container button[type="submit"] {
            padding: 10px 20px;
            border-radius: 25px;
            background-color: #f1c40f;
            color: #333;
            border: none;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .search-container button[type="submit"]:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <nav>
        <a href="/home_pg.php">Home</a>
        <!-- Modify these links as needed -->
        <a href="/logout.php">Logout</a>
    </nav>
    <h1>League of Legends Stats</h1>
    <div class="search-container">
        <form method="post" action="/">
            <input type="text" name="playerName" placeholder="Enter Player Name">
            <button type="submit" name="search">Search</button>
        </form>
    </div>
    <table>
        <thead>
            <tr>
                <th>Player Name</th>
                <th>Team</th>
                <th>GP</th>
                <th>W</th>
                <th>L</th>
                <th>W/L</th>
                <th>K</th>
                <th>D</th>
                <th>A</th>
                <th>KDA</th>
                <th>CS</th>
                <th>CS/M</th>
                <th>G</th>
                <th>G/M</th>
                <th>Damage</th>
                <th>Damage/M</th>
                <th>Kill Participation</th>
                <th>Kill Share</th>
                <th>Gold Share</th>
                <!-- Add other headers as required -->
            </tr>
        </thead>
        <tbody>
            <?php
            if ($player_data) {
                foreach ($player_data as $player) {
                    echo "<tr>";
                    echo "<td>" . $player['name'] . "</td>";
                    echo "<td>" . $player['team'] . "</td>";
                    echo "<td>" . $player['games_played'] . "</td>";
                    echo "<td>" . $player['wins'] . "</td>";
                    echo "<td>" . $player['losses'] . "</td>";
                    echo "<td>" . $player['win_rate'] . "</td>";
                    echo "<td>" . $player['kills'] . "</td>";
                    echo "<td>" . $player['deaths'] . "</td>";
                    echo "<td>" . $player['assists'] . "</td>";
                    echo "<td>" . $player['kda'] . "</td>";
                    echo "<td>" . $player['cs'] . "</td>";
                    echo "<td>" . $player['cs_per_min'] . "</td>";
                    echo "<td>" . $player['gold'] . "</td>";
                    echo "<td>" . $player['gold_per_min'] . "</td>";
                    echo "<td>" . $player['damage'] . "</td>";
                    echo "<td>" . $player['damage_per_min'] . "</td>";
                    echo "<td>" . $player['kill_participation'] . "</td>";
                    echo "<td>" . $player['kill_share'] . "</td>";
                    echo "<td>" . $player['gold_share'] . "</td>";
                    // Add other fields as required
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='19'>No data available</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
