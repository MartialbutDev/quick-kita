<?php
require 'vendor/autoload.php';

try {
    $client = new MongoDB\Client('mongodb://127.0.0.1:27017');
    $databases = $client->listDatabases();
    echo "MongoDB Connected Successfully!\n";
    echo "Available databases:\n";
    foreach ($databases as $database) {
        echo "- " . $database->getName() . "\n";
    }
} catch (Exception $e) {
    echo "MongoDB Connection Failed: " . $e->getMessage() . "\n";
}
?>