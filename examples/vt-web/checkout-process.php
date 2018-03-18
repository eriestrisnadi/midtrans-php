<?php
require __DIR__ . '/../../vendor/autoload.php'; // composer autoload

use Lowsprofile\Midtrans\Methods\Veritrans;

// Set Your server key
Veritrans::$server_key = 'SERVER_KEY_HERE';
Veritrans::$is_production = false;

// Required
$transaction_details = [
    'order_id' => rand(),
    'gross_amount' => 145000, // no decimal allowed for creditcard
];

// Optional
$item_details = [
    [
        'id' => 'a1',
        'price' => 50000,
        'quantity' => 2,
        'name' => "Apple"
    ],
    [
        'id' => 'a2',
        'price' => 45000,
        'quantity' => 1,
        'name' => "Orange"
    ],
];

// Optional
$billing_address = [
    'first_name'    => "Andri",
    'last_name'     => "Litani",
    'address'       => "Mangga 20",
    'city'          => "Jakarta",
    'postal_code'   => "16602",
    'phone'         => "081122334455",
    'country_code'  => 'IDN'
];

// Optional
$shipping_address = [
    'first_name'    => "Obet",
    'last_name'     => "Supriadi",
    'address'       => "Manggis 90",
    'city'          => "Jakarta",
    'postal_code'   => "16601",
    'phone'         => "08113366345",
    'country_code'  => 'IDN'
];

// Optional
$customer_details = [
    'first_name'    => "Andri",
    'last_name'     => "Litani",
    'email'         => "andri@litani.com",
    'phone'         => "081122334455",
    'billing_address'  => $billing_address,
    'shipping_address' => $shipping_address,
];

// Fill transaction details
$transaction = [
    'payment_type' => 'vtweb',
    'vtweb' => [
      'credit_card_3d_secure' => true
    ],
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
];

try {
    // Redirect to Veritrans VTWeb page
    header('Location: ' . Veritrans::charge($transaction)->redirect_url);
}
catch (Exception $e) {
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
