<?php


function displayRow($data) {
    echo "<tr>";
    foreach ($data as $part) {
        echo "<td>" . htmlspecialchars($part) . "</td>";
    }
    echo "</tr>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>League of Legends Stats</title>
    <img src='logo.png' alt='Logo Image'>
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

        img {
            margin-top: 60px;
            margin-bottom: 20px;
            max-width: 50%; /* Ensures the logo doesn't exceed its container */
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
            margin-top: 20px; /* Adjusted margin top to create space below the navbar */
        }

        table {
            width: 95%; /* Adjusted width to avoid overflowing */
            max-width: 1200px;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow-x: auto;
        }

        th,
        td {
            border: 1px solid #fff;
            padding: 6px;
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
            width: 300px;
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

        /* Style dropdown to match button */
        .search-container select {
            padding: 10px 20px;
            border-radius: 25px;
            background-color: #f1c40f;
            color: #333;
            border: none;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .search-container select:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <nav>
        <a href="/home_pg.php">Home</a>
        <!-- Modify these links as needed -->
        <a href="/logout.php">Logout</a>
    </nav>
    <h1>League of Legends Stats</h1>
    <div class="search-container">
    <form method="post" action="/landing.php">
        <input type="text" name="playerName" placeholder="Enter Player Name">
        <div class="country-buttons">
            <button type="button" class="country-button" data-country="USA">USA</button>
            <button type="button" class="country-button" data-country="China">China</button>
            <button type="button" class="country-button" data-country="Korea">Korea</button>
        </div>
        <input type="hidden" id="selected-country" name="selectedCountry"> <!-- Hidden input field for selected country -->
        <button type="submit" style="display: none;"></button> <!-- Hidden submit button -->
    </form>
</div>
    <table>
        <thead>
            <tr>
                <?php
                // Define the headers statically based on your data model
                $headers = [
                    'Player Name', 'GP', 'W', 'L', 'W/L', 'K', 'D', 'A', 'KDA', 'CS', 
                    'CS/M', 'G', 'G/M', 'Damage', 'Damage/M', 'Kill Participation', 
                    'Kill Share', 'Gold Share', 'Champions Played'
                ];

                // Display the table headers
                foreach ($headers as $header) {
                    echo "<th>" . htmlspecialchars($header) . "</th>";
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
require_once __DIR__ . '/vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form submission
    if (isset($_POST['selectedCountry'])) {
        $selectedCountry = $_POST['selectedCountry'];

        // RabbitMQ configurations for each country
        $rabbitmq_host = '10.198.120.107'; // Update with your RabbitMQ server host
        $rabbitmq_port = 5672;
        $rabbitmq_user = 'it490';
        $rabbitmq_password = 'it490';
        $rabbitmq_queue_send = '';
        $rabbitmq_queue_receive = '';

        // Define the RabbitMQ queue names based on the selected country
        switch ($selectedCountry) {
            case 'USA':
                $rabbitmq_queue_send = 'playerData_FTOB_US';
                $rabbitmq_queue_receive = 'playerData_BTOF_US';
                $messageToSend = "Requesting US PlayerData";
                break;
            case 'China':
                $rabbitmq_queue_send = 'playerData_FTOB_C';
                $rabbitmq_queue_receive = 'playerData_BTOF_C';
                $messageToSend = "Requesting C PlayerData";
                break;
            case 'Korea':
                $rabbitmq_queue_send = 'playerData_FTOB_K';
                $rabbitmq_queue_receive = 'playerData_BTOF_K';
                $messageToSend = "Requesting K PlayerData";
                break;
            default:
                // Handle other cases or errors
                break;
        }

        if ($rabbitmq_queue_send !== '' && $rabbitmq_queue_receive !== '') {

            $connectionS = new AMQPStreamConnection($rabbitmq_host, $rabbitmq_port, $rabbitmq_user, $rabbitmq_password);
            $channelS = $connectionS->channel();

            // Publish a message to indicate the selected country
            $msg = new AMQPMessage($messageToSend);
            $channelS->basic_publish($msg, '', $rabbitmq_queue_send);

            // Close the channel and connection after sending the message
            $channelS->close();
            $connectionS->close();

            $connectionR = new AMQPStreamConnection($rabbitmq_host, $rabbitmq_port, $rabbitmq_user, $rabbitmq_password);
            $channelR = $connectionR->channel();

            $channelR->queue_declare($rabbitmq_queue_receive, false, true, false, false);

            $decodedData = '';

            $callback = function ($msg) use (&$decodedData) {
                $decoded_message = utf8_decode($msg->body);

                if (strpos($decoded_message, ',') !== false) {
                    $decodedData .= $decoded_message;
                } else {
                    $decodedData .= $decoded_message;
                    $message_parts = explode(',', $decodedData);

                    if (count($message_parts) === 19) {
                        displayRow($message_parts); // Display a row for each set of data
                        $decodedData = '';
                    } else {
                        echo "Received incomplete or invalid data: ", $decodedData, "<br>";
                    }

                    $msg->delivery_info['channelR']->basic_ack($msg->delivery_info['delivery_tag']);
                }
            };

            $channelR->basic_consume($rabbitmq_queue_receive, '', false, false, false, false, $callback);

            while (count($channelR->callbacks)) {
                $channelR->wait();
            }

            $channelR->close();
            $connectionR->close();
        } else {
            echo "Invalid RabbitMQ queue or country selection";
        }
    }
}
    ?>
        </tbody>
    </table>
    <script>
    // Add click event listener to country buttons
    document.addEventListener('DOMContentLoaded', function() {
        const countryButtons = document.querySelectorAll('.country-button');
        countryButtons.forEach(button => {
            button.addEventListener('click', function() {
                const selectedCountry = this.getAttribute('data-country');
                document.getElementById('selected-country').value = selectedCountry;
                document.querySelector('form').submit(); // Submit the form
            });
        });
    });
</script>
</body>
</html>
