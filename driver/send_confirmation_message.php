<?php
// send_confirmation_message.php

require_once('./../config.php');
require_once __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

$booking_id = $_POST['booking_id'];

// Retrieve client contact based on booking ID
$qry = $conn->query("SELECT c.client_id, cl.contact
                    FROM booking_list c
                    INNER JOIN client_list cl ON c.client_id = cl.id
                    WHERE c.id = '{$booking_id}'");

if ($qry->num_rows > 0) {
    $data = $qry->fetch_assoc();
    $client_contact = $data['contact'];

    // Send SMS using Twilio
    $twilio_sid = 'ACe2dc300e1f7206de05a3bfcc53ad9b41';
    $twilio_token = 'b9b1e1fbb6aab0537c547e9fce212322';
    $twilio_phone_number = '+12097846021';
    $client = new Client($twilio_sid, $twilio_token);

    // Replace 'your_message_here' with the actual message you want to send
    $message = $client->messages->create(
        $client_contact,
        [
            'from' => $twilio_phone_number,
            'body' => 'Your booking has been confirmed. Thank you for choosing our service!'
        ]
    );

    // Respond to the frontend
    if ($message->sid) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error']);
    }
} else {
    echo json_encode(['status' => 'error']);
}
?>
