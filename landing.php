<?php
require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

// Your RabbitMQ connection and queue details
$rabbitmq_host = '10.198.120.107'; // Update with your RabbitMQ server host
$rabbitmq_port = 5672;
$rabbitmq_user = 'it490';
$rabbitmq_password = 'it490';
$rabbitmq_queue_receive = 'playerStats';

// Establish connection to RabbitMQ
$connection = new AMQPStreamConnection($rabbitmq_host, $rabbitmq_port, $rabbitmq_user, $rabbitmq_password);
$channel = $connection->channel();

// Declare queue to receive messages
$channel->queue_declare($rabbitmq_queue_receive, false, true, false, false);

// Callback function to process received messages
$callback = function ($msg) {
    // Extracting and processing received message
    $received_message = $msg->body;
    
    // Split the received message into individual stats
    $stats = explode(',', $received_message);

    // Display the statistics (Modify as per your HTML structure)
    echo "<!DOCTYPE html>
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
            <tr>";

    foreach ($stats as $stat) {
        echo "<td>{$stat}</td>"; // Display each stat in a table cell
    }

    echo "</tr></tbody></table></body></html>";
};

// Consume messages from the queue
$channel->basic_consume($rabbitmq_queue_receive, '', false, true, false, false, $callback);

// Keep the connection open and continue processing messages
while ($channel->is_open()) {
    $channel->wait();
}

// Close the channel and connection after processing
$channel->close();
$connection->close();
?>
