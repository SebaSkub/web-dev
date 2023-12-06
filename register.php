<?php
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

require_once __DIR__ . '/vendor/autoload.php'; // Include the Composer autoloader

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $rabbitmq_host = '10.198.120.138'; // Update with your RabbitMQ server host
    $rabbitmq_port = 5672;
    $rabbitmq_user = 'it490';
    $rabbitmq_password = 'it490';
    $rabbitmq_queue_send = 'userRegister_FTOB';
    $rabbitmq_queue_receive = 'userRegister_BTOF';

    $connectionSend = new AMQPStreamConnection($rabbitmq_host, $rabbitmq_port, $rabbitmq_user, $rabbitmq_password);
    $channelSend = $connectionSend->channel();
    $channelSend->queue_declare($rabbitmq_queue_send, false, true, false, false);
    $email = $_POST['email'];
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $lol_id = $_POST['lolId'];
    $steam_link = $_POST['steamLink'];
    $security_question1 = $_POST['securityQuestion1'];
    $security_question2 = $_POST['securityQuestion2'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the data as a comma-separated string
    $registration_data = "$email,$first_name,$last_name,$dob,$age,$lol_id,$steam_link,$security_question1,$security_question2,$username,$password";

    $msg = new AMQPMessage($registration_data);
    $channelSend->basic_publish($msg, '', $rabbitmq_queue_send);

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
	    if ($response === 'Backend acknowledges successful registration of new user') {
		   header("Location:/login_pg.php");
		   exit;
	    } elseif ($response === 'Backend acknowledges failed registration of the new user') {
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
    $channelReceive->basic_consume($rabbitmq_queue_receive, '', false,true, false, false, $callback);
    while (count($channelReceive->callbacks)) {
	    $channelReceive->wait();
    }
    $channelReceive->close();
    $connectionReceive->close();



    // Redirect to the login page after successful registration
    header("Location: /login_pg.php");
    exit;
}
?>
