
<?php
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
// Including the Composer autoloader for RabbitMQ library
require_once __DIR__ . '/vendor/autoload.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // RabbitMQ configurations
    $rabbitmq_host = '10.198.120.138'; // Update with your RabbitMQ server host
    $rabbitmq_port = 5672;
    $rabbitmq_user = 'it490';
    $rabbitmq_password = 'it490';
    $rabbitmq_queue_send = 'userRegister_FTOB'; // Outbound queue name
    $rabbitmq_queue_receive = 'userRegister_BTOF'; // Inbound queue name

    // Establishing connection to send data
    $connectionSend = new AMQPStreamConnection($rabbitmq_host, $rabbitmq_port, $rabbitmq_user, $rabbitmq_password);
    $channelSend = $connectionSend->channel();
    $channelSend->queue_declare($rabbitmq_queue_send, false, true, false, false);

    // Retrieving form data
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

    // Create and send AMQP message
    $msg = new AMQPMessage($registration_data);
    $channelSend->basic_publish($msg, '', $rabbitmq_queue_send);

    // Close the sending channel and connection
    $channelSend->close();
    $connectionSend->close();

    // Receiving Data 
    $connectionReceive = new AMQPStreamConnection($rabbitmq_host, $rabbitmq_port, $rabbitmq_user, $rabbitmq_password);
    $channelReceive = $connectionReceive->channel();
    $channelReceive->queue_declare($rabbitmq_queue_receive, false, true, false, false);

    // Waiting for a response
    $callback = function ($msg) {
        $response = $msg->body;

        // Handling different responses from RabbitMQ
        if ($response === 'User Registration was successful -- Database, Backend') {
            header("Location:/login_pg.php"); // Redirect to login page on successful registration
            exit;
        } elseif ($response === 'User Registration was unsuccessful -- Database, Backend') {
            // Displaying an error message for unsuccessful registration
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
        } else {
            // Displaying an error message for existing username
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    var errorBox = document.createElement('div');
                    errorBox.className = 'error-box';
                    errorBox.innerHTML = 'Invalid Username, username already exists. Please try again.';
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

    // Consume messages from the receive queue
    $channelReceive->basic_consume($rabbitmq_queue_receive, '', false, true, false, false, $callback);
    while (count($channelReceive->callbacks)) {
        $channelReceive->wait();
    }

    // Close the receiving channel and connection
    $channelReceive->close();
    $connectionReceive->close();

    // Redirect to the login page after successful registration
    header("Location: /login_pg.php");
    exit;
}
?>
