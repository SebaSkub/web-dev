<?php
// Establish database connection
$servername = "your_servername";
$username = "your_username";
$password = "your_password";
$dbname = "your_dbname";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Fetch all player stats or based on the provided player name
if (isset($_GET['player_name'])) {
    $playerName = $_GET['player_name'];
    
    $stmt = $conn->prepare("SELECT * FROM PlayerStats WHERE league_name LIKE :playerName");
    $stmt->bindValue(':playerName', "%$playerName%", PDO::PARAM_STR);
    $stmt->execute();
    $playerStats = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $stmt = $conn->prepare("SELECT * FROM PlayerStats");
    $stmt->execute();
    $playerStats = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>League of Legends Stats</title>
    <!-- Your CSS styling here -->
</head>
<body>
    <h1>League of Legends Stats</h1>

    <!-- Search bar -->
    <div class="search-bar">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            <input type="text" name="player_name" placeholder="Search by Player Name">
            <input type="submit" value="Search">
        </form>
    </div>

    <!-- Table of player stats -->
    <table border="1">
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
                <th>Gold/M</th>
                <th>Damage</th>
                <th>Damage/M</th>
                <th>KPAR</th>
                <th>KS</th>
                <th>GS</th>
                <th>CP</th>
                <th>Champions</th>
                <!-- Add headers for other columns -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($playerStats as $stat): ?>
                <tr>
                    <!-- Display player stats within table rows -->
                    <td><?php echo $stat['league_name']; ?></td>
                    <td><?php echo $stat['games_played']; ?></td>
                    <td><?php echo $stat['wins']; ?></td>
                    <td><?php echo $stat['losses']; ?></td>
                    <td><?php echo $stat['win_rate']; ?></td>
                    <td><?php echo $stat['kills']; ?></td>
                    <td><?php echo $stat['deaths']; ?></td>
                    <td><?php echo $stat['assists']; ?></td>
                    <td><?php echo $stat['kda']; ?></td>
                    <td><?php echo $stat['cs']; ?></td>
                    <td><?php echo $stat['cs_per_min']; ?></td>
                    <td><?php echo $stat['gold']; ?></td>
                    <td><?php echo $stat['gold_per_min']; ?></td>
                    <td><?php echo $stat['damage']; ?></td>
                    <td><?php echo $stat['damage_per_min']; ?></td>
                    <td><?php echo $stat['kpar']; ?></td>
                    <td><?php echo $stat['ks']; ?></td>
                    <td><?php echo $stat['gs']; ?></td>
                    <td><?php echo $stat['cp']; ?></td>
                    <td><?php echo $stat['champions']; ?></td>
                    <!-- Display other stats -->
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
