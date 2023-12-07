<?php
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

require_once __DIR__ . '/vendor/autoload.php'; // Include the Composer autoloader

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rabbitmq_host = '10.198.120.138'; // Update with your RabbitMQ server host
    $rabbitmq_port = 5672;
    $rabbitmq_user = 'it490';
    $rabbitmq_password = 'it490';
    $rabbitmq_queue_send = 'userLogin_FTOB';
    $rabbitmq_queue_receive = 'userLogin_BTOF';

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the data as a comma-separated string
    $data = "$username,$password";

    // Initialize a connection to RabbitMQ
    $connectionSend = new AMQPStreamConnection($rabbitmq_host, $rabbitmq_port, $rabbitmq_user, $rabbitmq_password);
    $channelSend = $connectionSend->channel();
    $channelSend->queue_declare($rabbitmq_queue_send, false, true, false, false);

    // Send the data to RabbitMQ in the desired format
    $message = new AMQPMessage($data);
    $channelSend->basic_publish($message, '', $rabbitmq_queue_send);

    // Close the connection
    $channelSend->close();
    $connectionSend->close();

    // Receiving Data 
    $connectionReceive = new AMQPStreamConnection($rabbitmq_host, $rabbitmq_port, $rabbitmq_user, $rabbitmq_password);
    $channelReceive = $connectionReceive->channel();
    $channelReceive->queue_declare($rabbitmq_queue_receive, false, true, false, false);

    //Waiting for a response
    $callback = function ($msg) {
	    $response = $msg->body;
	    if ($response === 'User Login was successful -- Database, Backend') {
		   header("Location:/landing.php");
		   exit;
	    } elseif ($response === 'User Login was unsuccessful -- Database, Backend') {
		    //Invalid Login display a notification
		    echo "<script>
			    document.addEventListener('DOMContentLoaded', function() {
				var errorBox = document.createElement('div');
				errorBox.className = 'error-box';
				errorBox.innerHTML = 'Invalid Login. Please try again.';
				document.body.appendChild(errorBox);

				setTimeout(function() { 
					document.body.removeChild(errorBox);	
				}, 5000);  // Remove the box after 5 seconds
			    });
			</script>";
		    exit;
	   }
	   $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
    };
    $channelReceive->basic_consume($rabbitmq_queue_receive, '', false, true, false, false, $callback);
    while (count($channelReceive->callbacks)) {
	    $channelReceive->wait();
    }
    $channelReceive->close();
    $connectionReceive->close();

}
?>
