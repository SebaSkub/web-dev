

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
        <h1>Leaderboard</h1>
    <div id="leaderboard-container">
        <h2>Leaderboard</h2>
        <table id="leaderboard-table">
            <!-- Table content will be populated dynamically -->
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
                    <!-- Add other headers based on your knowledge -->
                </tr>
            </thead>
            <tbody>
                <!-- Table content will be populated dynamically -->
            </tbody>
        </table>
    </div>

    <?php
    // URL to scrape
    $url = 'https://lol.fandom.com/wiki/LPL/2023_Season/Summer_Season/Player_Statistics';

    // Get the HTML of the page
    $html = file_get_contents($url);

    // Create a DOMDocument object
    $dom = new DOMDocument();
    libxml_use_internal_errors(true); // Suppress errors caused by invalid HTML
    $dom->loadHTML($html);
    libxml_clear_errors();

    // Find the table with player statistics
    $tables = $dom->getElementsByTagName('table');
    foreach ($tables as $table) {
        $classAttribute = $table->getAttribute('class');
        if (strpos($classAttribute, 'wikitable') !== false) {
            $tbody = $table->getElementsByTagName('tbody')->item(0);
            $rows = $tbody->getElementsByTagName('tr');

            // Display the data in a table
            echo '<script>';
            echo 'var tableContent = "<tbody>"';
            foreach ($rows as $row) {
                $cells = $row->getElementsByTagName('td');
                if ($cells->length > 0) {
                    echo 'tableContent += "<tr>"';
                    foreach ($cells as $cell) {
                        echo 'tableContent += "<td>"' . $cell->nodeValue . '"</td>"';
                    }
                    echo 'tableContent += "</tr>"';
                }
            }
            echo 'tableContent += "</tbody>";';
            echo 'document.getElementById("leaderboard-table").innerHTML = tableContent;';
            echo '</script>';
        }
    }
    ?>

</body>
</html>
