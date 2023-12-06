<!DOCTYPE html>
<html>
<head>
    <title>League of Legends Stats</title>
    <img src='logo.jpeg' alt='Logo Image'>

    <style>
        /* Your CSS styling here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        
        h1 {
            text-align: center;
            color: #333;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: center;
        }
        
        th {
            background-color: #333;
            color: #fff;
        }
        
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
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
                <th>Creep Score</th>
                <!-- Add other headers here -->
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
