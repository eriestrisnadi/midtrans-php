<?php
require __DIR__ . '/../../vendor/autoload.php'; // composer autoload

use Lowsprofile\Midtrans\Methods\Midtrans;

// Set Your server key
Midtrans::$server_key = 'SERVER_KEY_HERE';
Midtrans::$is_production = false;

// Required
$transaction_details = [
    'order_id' => rand(),
    'gross_amount' => 94000, // no decimal allowed for creditcard
];

// Optional
$item_details = [
    [
      'id' => 'a1',
      'price' => 94000,
      'quantity' => 1,
      'name' => "Apple"
    ],
];

// Optional
$customer_details = [
    'first_name'    => "Andri",
    'last_name'     => "Litani",
    'email'         => "andri@litani.com",
    'phone'         => "081122334455",
];

// Fill transaction details
$transaction = [
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
];

$snapToken = Midtrans::snapToken($transaction);
echo "snapToken = " . $snapToken;
?>

<!DOCTYPE html>
<html>
    <body>
        <button id="pay-button">Pay!</button>
        <!-- TODO: Remove ".sandbox" from script src URL for production environment.
             Also input your client key in "data-client-key" -->
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="CLIENT_KEY_HERE"></script>
        <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
            // SnapToken acquired from previous step
            snap.pay('<?= $snapToken ?>');
        };
        </script>
    </body>
</html>
