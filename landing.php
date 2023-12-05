<!DOCTYPE html>
<html>
<head>
    <title>League of Legends Stats</title>
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
                <th>Champions Played</th>
            </tr>
        </thead>
        <tbody>
            {% for stat in player_stats %}
            <tr>
                <td>{{ stat.league_name }}</td>
                <td>{{ stat.games_played }}</td>
                <td>{{ stat.wins }}</td>
                <td>{{ stat.losses }}</td>
                <td>{{ stat.win_rate }}</td>
                <td>{{ stat.kills }}</td>
                <td>{{ stat.deaths }}</td>
                <td>{{ stat.assists }}</td>
                <td>{{ stat.kda }}</td>
                <td>{{ stat.cs }}</td>
                <td>{{ stat.cs_per_min }}</td>
                <td>{{ stat.gold }}</td>
                <td>{{ stat.gold_per_min }}</td>
                <td>{{ stat.damage }}</td>
                <td>{{ stat.damage_per_min }}</td>
                <td>{{ stat.kill_participation }}</td>
                <td>{{ stat.kill_share }}</td>
                <td>{{ stat.gold_share }}</td>
                <td>{{ stat.creep_score }}</td>
                <td>{{ stat.champions_played }}</td>
                <!-- Include other table data for your stats -->
            </tr>
            {% endfor %}
        </tbody>
    </table>
</body>
</html>
