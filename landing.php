<!DOCTYPE html>
<html>
<head>
    <title>League of Legends Stats</title>
    <img src='logo.jpeg' alt='Logo Image'>

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
    <h1>League of Legends Stats</h1>
    <table>
        <thead>
            <tr>
                <th>League Name</th>
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
                <!-- Include other headers here -->
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php foreach ($stats as $stat): ?>
                    <td><?php echo $stat; ?></td>
                <?php endforeach; ?>
            </tr>
        </tbody>
    </table>
</body>
</html>
