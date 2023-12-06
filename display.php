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

    // Include the HTML template to display the statistics
    include('landing.php');
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
