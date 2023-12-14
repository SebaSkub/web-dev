


<!DOCTYPE html>
<html>
<head>
    <title>League of Legends Stats</title>
    <img src='logo.png' alt='Logo Image'>

    <style>
     img {
            margin-top: 50px; /* Adjust the margin-top value as needed */
        }
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
    margin-top: 60px; /* Adjusted margin top to create space below the navbar */
}

table {
    width: 80%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

th,
td {
    border: 1px solid #fff;
    padding: 8px;
    text-align: center;
}

th {
    background-color: #333;
}

tr:nth-child(even) {
    background-color: #444;
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
            width: 300px; /* Adjust width as needed */
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
        <a href="/login_pg.php">Login</a> 
        <a href="/register_pg.php">Register</a>
        <!-- Add more navigation links as needed -->
    </nav>
    <h1>League of Legends Stats</h1>
    <!-- Search form for LolID input -->
    <div class="search-container">
        <form method="post" action="">
            <input type="text" name="playerName" placeholder="Enter Player Name">
            <button type="submit" name="search">Search</button>
        </form>
    </div>
    <table>
        <thead>
            <tr>
                <th>Player Name</th>
                <th>Team</th>
                <th>Games Played</th>
                <th>Wins</th>
                <th>Losses</th>
                <th>Win Rate</th>
                <th>Kills</th>
                <th>Deaths</th>
                <th>Assists</th>
                <th>KDA</th>
                <th>CS</th>
                <th>CS/M</th>
                <th>Gold</th>
                <th>Gold/Min</th>
                <th>Damage</th>
                <th>Damage/Min</th>
                <th>Kill Participation</th>
                <th>Kill Share</th>
                <th>Gold Share</th>
                <!-- Add other headers as required -->
            </tr>
        </thead>
    <tbody>
          <?php
            function scrape_player_data($playerName) {
                $url = 'https://lol.fandom.com/wiki/' . urlencode($playerName) . '/Statistics';
                $response = file_get_contents($url);

                if ($response !== false) {
                    $html = new DOMDocument();
                    @$html->loadHTML($response);
                    $xpath = new DOMXPath($html);

                    $tableRows = $xpath->query("//table[contains(@class, 'wikitable')][2]/tbody/tr[position()>3]");

                    foreach ($tableRows as $row) {
                        echo "<tr>";
                        foreach ($row->childNodes as $cell) {
                            echo "<td>" . $cell->nodeValue . "</td>";
                        }
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='18'>Failed to retrieve player data.</td></tr>";
                }
            }

            if (isset($_POST['search'])) {
                $playerName = $_POST['playerName'];
                scrape_player_data($playerName);
            }
            ?>
        </tbody>
    </table>
   
</body>
</html>
