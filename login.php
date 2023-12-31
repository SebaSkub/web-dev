<?php
#---------------------------------------------
#           UserLogin -> RabbitMQ
#           By: Sebastian Skubisz
#---------------------------------------------

# Including the Composer autoloader for RabbitMQ library

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

require_once __DIR__ . '/vendor/autoload.php';
session_start(); 
#---------------------------------------------
# Check if the request method is POST
#---------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    #---------------------------------------------
    # RabbitMQ configurations
    #---------------------------------------------
    $rabbitmq_host = '10.198.120.107'; # Update with your RabbitMQ server host
    $rabbitmq_port = 5672;
    $rabbitmq_user = 'it490';
    $rabbitmq_password = 'it490';
    $rabbitmq_queue_send = 'userLogin_FTOB'; # Outbound queue name
    $rabbitmq_queue_receive = 'userLogin_BTOF'; # Inbound queue name

    # Retrieving form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    # Prepare the data as a comma-separated string
    $data = "$username,$password";

    # Initialize a connection to RabbitMQ for sending data
    $connectionSend = new AMQPStreamConnection($rabbitmq_host, $rabbitmq_port, $rabbitmq_user, $rabbitmq_password);
    $channelSend = $connectionSend->channel();
    $channelSend->queue_declare($rabbitmq_queue_send, false, true, false, false);

    # Send the data to RabbitMQ in the desired format
    $message = new AMQPMessage($data);
    $channelSend->basic_publish($message, '', $rabbitmq_queue_send);

    # Close the sending channel and connection
    $channelSend->close();
    $connectionSend->close();

    # Receiving Data 
    $connectionReceive = new AMQPStreamConnection($rabbitmq_host, $rabbitmq_port, $rabbitmq_user, $rabbitmq_password);
    $channelReceive = $connectionReceive->channel();
    $channelReceive->queue_declare($rabbitmq_queue_receive, false, true, false, false);

    # Waiting for a response
    $callback = function ($msg) {
        $response = $msg->body;

        # Handling different responses from RabbitMQ
        if ($response === 'User Login was successful -- Database, Backend') {
            $_SESSION['loggedin'] = true;
            header("Location:/home_pg.php"); # Redirect to landing page on successful login
            exit;
        } elseif ($response === 'User Login was unsuccessful -- Database, Backend') {
            # Displaying an error message for unsuccessful login
            echo '<script>';
            echo 'alert("Credentials Not Correct. Please try again.");';
            echo 'setTimeout(function() { window.location.href = "/login_pg.php"; }, 2000);';
            echo '</script>';
        }
        # Acknowledge the message received
        $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
    };

    # Consume messages from the receive queue
    $channelReceive->basic_consume($rabbitmq_queue_receive, '', false, true, false, false, $callback);
    while (count($channelReceive->callbacks)) {
        $channelReceive->wait();
    }

    # Close the receiving channel and connection
    $channelReceive->close();
    $connectionReceive->close();
}
?>
