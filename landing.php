<!DOCTYPE html>
<html>
<head>
    <title>League of Legends Stats</title>
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

        table {
            width: 90%;
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
    </style>
</head>
<body>
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
            tbody>
            <?php
            function scrape_player_data($url) {
                $command = "python3 webscraper.py " . escapeshellarg($url);
                $output = shell_exec($command);
                return json_decode($output, true);
            }

            $url = 'https://lol.fandom.com/wiki/LPL/2023_Season/Summer_Season/Player_Statistics';
            $scraped_data = scrape_player_data($url);

            if ($scraped_data) {
                foreach ($scraped_data as $row) {
                    echo "<tr>";
                    foreach ($row as $cell) {
                        echo "<td>" . $cell . "</td>";
                    }
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='18'>No data available.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
