<?php

// Define a function to log events
function logEvent($message, $type = 'INFO') {
    // Set the log file path
    $logFile = __DIR__ . 'C:\wamp64\www\FoodOrderApp\logfile';

    // Format the log message with a timestamp
    $timestamp = date('Y-m-d H:i:s');
    $formattedMessage = "[$timestamp] [$type]: $message" . PHP_EOL;

    // Ensure the logs directory exists
    if (!is_dir(__DIR__ . 'C:\wamp64\www\FoodOrderApp\logfile')) {
        mkdir(__DIR__ . 'C:\wamp64\www\FoodOrderApp\logfile', 0777, true);
    }

    // Append the message to the log file
    file_put_contents($logFile, $formattedMessage, FILE_APPEND | LOCK_EX);
}

// Example usage
logEvent('This is an informational message.');
logEvent('This is an error message.', 'ERROR');
logEvent('A user logged in.', 'INFO');
?>
