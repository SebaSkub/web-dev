<?php
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
                            $rabbitmq_queue_send = 'playerData_BTOF_US';
                            $rabbitmq_queue_receive = 'playerData_BTOF_US';
                            break;
                        case 'China':
                            $rabbitmq_queue_send = 'playerData_BTOF_C';
                            $rabbitmq_queue_receive = 'playerData_BTOF_C';
                            break;
                        case 'Korea':
                            $rabbitmq_queue_send = 'playerData_BTOF_K';
                            $rabbitmq_queue_receive = 'playerData_BTOF_K';
                            break;
                        default:
                            // Handle other cases or errors
                            break;
                    }

                    if ($rabbitmq_queue_send !== '' && $rabbitmq_queue_receive !== '') {

                        $connection = new AMQPStreamConnection($rabbitmq_host, $rabbitmq_port, $rabbitmq_user, $rabbitmq_password);
                        $channel = $connection->channel();

                        $channel->queue_declare($rabbitmq_queue_receive, false, true, false, false);

                        // Display a message indicating waiting for data
                        echo 'Waiting for messages. To exit, press CTRL+C', "<br>";

                        $headersDisplayed = false;

                        $decodedData = '';

                        $callback = function ($msg) use (&$decodedData, &$headersDisplayed) {
                            $decoded_message = utf8_decode($msg->body);

                            if (strpos($decoded_message, ',') !== false) {
                                $decodedData .= $decoded_message;
                            } else {
                                $decodedData .= $decoded_message;
                                $message_parts = explode(',', $decodedData);

                                if (count($message_parts) === 19) {
                                    if (!$headersDisplayed) {
                                        // Display table headers
                                        echo "<tr>";
                                        foreach ($message_parts as $header) {
                                            echo "<th>" . htmlspecialchars($header) . "</th>";
                                        }
                                        echo "</tr>";
                                        $headersDisplayed = true;
                                    } else {
                                        // Display data rows
                                        displayRow($message_parts);
                                    }
                                    $decodedData = '';
                                } else {
                                    echo "Received incomplete or invalid data: ", $decodedData, "<br>";
                                }

                                $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
                            }
                        };

                        $channel->basic_consume($rabbitmq_queue_receive, '', false, false, false, false, $callback);

                        while (count($channel->callbacks)) {
                            $channel->wait();
                        }

                        $channel->close();
                        $connection->close();
                    }
                }
            }
            ?>
