

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
    <?php
    function scrapePlayerData($url) {
        // Get the HTML content from the provided URL
        $html = file_get_contents($url);

        // Check if the request was successful
        if ($html !== false) {
            $dom = new DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($html);
            libxml_clear_errors();

            // Find the specific table you want to scrape
            $tables = $dom->getElementsByTagName('table');
            $targetTable = null;
            foreach ($tables as $table) {
                $classAttribute = $table->getAttribute('class');
                if (strpos($classAttribute, 'wikitable') !== false) {
                    $targetTable = $table;
                    break;
                }
            }

            // Check if the table is found
            if ($targetTable) {
                // Extract and accumulate the data for each player into a single string
                $rowsToSkip = 5;
                $rows = $targetTable->getElementsByTagName('tr');
                $playerDataList = [];
                foreach ($rows as $index => $row) {
                    if ($index >= $rowsToSkip) {
                        $cells = $row->getElementsByTagName('td');
                        $rowData = [];
                        foreach ($cells as $cell) {
                            $rowData[] = $cell->nodeValue;
                        }
                        $playerDataList[] = implode(' ', $rowData);
                    }
                }

                // Join all player data into a single string separated by newlines
                $result = implode("\n", $playerDataList);
                echo $result;
            } else {
                echo "Table not found on the page.";
            }
        } else {
            echo "Failed to retrieve the page.";
        }
    }

    // Example usage:
    $url = 'https://lol.fandom.com/wiki/LPL/2023_Season/Summer_Season/Player_Statistics';
    scrapePlayerData($url);
    ?>
</body>
</html>
