<!DOCTYPE html>
<html>
<head>
    <style>
        /* Your CSS styling here */
        body {
            font-family: Arial, sans-serif;
            background-color: #222;
            color: #fff;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        
        h1 {
            text-align: center;
            color: #ffcc00;
            margin-bottom: 20px;
        }

        img {
            display: block;
            margin: 0 auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        th, td {
            border: 1px solid #fff;
            padding: 8px;
            text-align: center;
        }
        
        th {
            background-color: #444;
        }
        
        tr:nth-child(even) {
            background-color: #333;
        }
    </style>
</head>
<body>
    <h1>League of Legends Stats</h1>
    <img src='logo.jpeg' alt='Logo Image'>
    <table>
        <thead>
            <tr>
                <th>League Name</th>
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
