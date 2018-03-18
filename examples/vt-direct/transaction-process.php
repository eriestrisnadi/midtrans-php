<?php
require __DIR__ . '/../../vendor/autoload.php'; // composer autoload

use Lowsprofile\Midtrans\Methods\Veritrans;

Veritrans::$server_key = 'SERVER_KEY_HERE';
Veritrans::$is_production = false;

$orderId = '1404189699';

try {
    $status = Veritrans::status($orderId);
} catch (Exception $e) {
    echo $e->getMessage();
    if($e->getCode() === 401){
        echo "<code>";
        echo "<h4>Please set real server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars('Veritrans::$server_key = \'SERVER_KEY_HERE\';');
    }
    die();
}

var_dump($status);

// $approve = Veritrans::approve($orderId);
// var_dump($approve);

// $cancel = Veritrans::cancel($orderId);
// var_dump($cancel);
