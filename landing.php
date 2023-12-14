


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
        <form method="post" action="" id="searchForm">
            <input type="text" name="playerName" placeholder="Enter Player Name">
            <button type="submit" name="search">Search</button>
        </form>
    </div>

    <table id="playerStatsTable">
        <!-- Table content will be populated here -->
    </table>

    <script>
        function displayPlayerData(playerData) {
            const table = document.getElementById('playerStatsTable');
            const rows = playerData.split('\n');

            rows.forEach(rowData => {
                const row = table.insertRow();
                const cells = rowData.split(' ');

                cells.forEach(cellData => {
                    const cell = row.insertCell();
                    cell.textContent = cellData;
                });
            });
        }

        function scrapePlayerData(url) {
            fetch(url)
                .then(response => response.text())
                .then(data => {
                    const parser = new DOMParser();
                    const htmlDoc = parser.parseFromString(data, 'text/html');
                    const targetTable = htmlDoc.querySelector('table.wikitable');

                    if (targetTable) {
                        const rowsToSkip = 5;
                        const rows = targetTable.querySelectorAll('tr');

                        let playerDataList = [];
                        for (let i = rowsToSkip; i < rows.length; i++) {
                            const cells = rows[i].querySelectorAll('td, th');
                            let rowData = '';
                            cells.forEach(cell => {
                                rowData += cell.textContent.trim() + ' ';
                            });
                            playerDataList.push(rowData.trim());
                        }

                        const playerData = playerDataList.join('\n');
                        displayPlayerData(playerData);
                    } else {
                        console.log('Table not found on the page.');
                    }
                })
                .catch(error => {
                    console.error('Failed to retrieve the page.', error);
                });
        }

        document.getElementById('searchForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const playerName = document.querySelector('input[name="playerName"]').value;
            const baseUrl = 'https://lol.fandom.com/wiki/';
            const url = `${baseUrl}${encodeURIComponent(playerName)}/Statistics`;
            scrapePlayerData(url);
        });
    </script>
</body>
</html>
