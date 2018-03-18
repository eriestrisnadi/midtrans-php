<?php
require __DIR__ . '/../../vendor/autoload.php'; // composer autoload

use Lowsprofile\Midtrans\Methods\Veritrans;

if(empty($_POST['token_id'])) {
    die('Empty token_id!');
}

Veritrans::$server_key = 'SERVER_KEY_HERE';
Veritrans::$is_production = false;

$transaction_details = [
  'order_id'    => time(),
  'gross_amount'  => 200000
];

// Populate items
$items = [
    [
      'id'       => 'item1',
      'price'    => 100000,
      'quantity' => 1,
      'name'     => 'Adidas f50'
    ],
    [
      'id'       => 'item2',
      'price'    => 50000,
      'quantity' => 2,
      'name'     => 'Nike N90'
    ],
];

// Populate customer's billing address
$billing_address = [
    'first_name'   => "Andri",
    'last_name'    => "Setiawan",
    'address'      => "Karet Belakang 15A, Setiabudi.",
    'city'         => "Jakarta",
    'postal_code'  => "51161",
    'phone'        => "081322311801",
    'country_code' => 'IDN'
];

// Populate customer's shipping address
$shipping_address = [
    'first_name'   => "John",
    'last_name'    => "Watson",
    'address'      => "Bakerstreet 221B.",
    'city'         => "Jakarta",
    'postal_code'  => "51162",
    'phone'        => "081322311801",
    'country_code' => 'IDN'
];

// Populate customer's info
$customer_details = [
    'first_name'       => "Andri",
    'last_name'        => "Setiawan",
    'email'            => "andri@setiawan.com",
    'phone'            => "081322311801",
    'billing_address'  => $billing_address,
    'shipping_address' => $shipping_address
];

// Token ID from checkout page
$token_id = $_POST['token_id'];

// Transaction data to be sent
$transaction_data = [
    'payment_type' => 'credit_card',
    'credit_card'  => [
      'token_id'      => $token_id,
      'bank'          => 'bni',
      'save_token_id' => isset($_POST['save_cc'])
    ],
    'transaction_details' => $transaction_details,
    'item_details'        => $items,
    'customer_details'    => $customer_details
];

try {
    $response = Veritrans::charge($transaction_data);
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

// Success
if($response->transaction_status == 'capture') {
    echo "<p>Transaksi berhasil.</p>";
    echo "<p>Status transaksi untuk order id $response->order_id: " .
        "$response->transaction_status</p>";

    echo "<h3>Detail transaksi:</h3>";
    echo "<pre>";
    var_dump($response);
    echo "</pre>";
}
// Deny
else if($response->transaction_status == 'deny') {
    echo "<p>Transaksi ditolak.</p>";
    echo "<p>Status transaksi untuk order id .$response->order_id: " .
        "$response->transaction_status</p>";

    echo "<h3>Detail transaksi:</h3>";
    echo "<pre>";
    var_dump($response);
    echo "</pre>";
}
// Challenge
else if($response->transaction_status == 'challenge') {
    echo "<p>Transaksi challenge.</p>";
    echo "<p>Status transaksi untuk order id $response->order_id: " .
        "$response->transaction_status</p>";

    echo "<h3>Detail transaksi:</h3>";
    echo "<pre>";
    var_dump($response);
    echo "</pre>";
}
// Error
else {
    echo "<p>Terjadi kesalahan pada data transaksi yang dikirim.</p>";
    echo "<p>Status message: [$response->status_code] " .
        "$response->status_message</p>";

    echo "<pre>";
    var_dump($response);
    echo "</pre>";
}

echo "<hr>";
echo "<h3>Request</h3>";
echo "<pre>";
var_dump($response);
echo "</pre>";
