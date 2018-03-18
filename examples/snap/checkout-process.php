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
        'price' => 18000,
        'quantity' => 3,
        'name' => "Apple"
    ],
    [
        'id' => 'a2',
        'price' => 20000,
        'quantity' => 2,
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

// Optional, remove this to display all available payment methods
$enable_payments = [
    'credit_card',
    'cimb_clicks',
    'mandiri_clickpay',
    'echannel',
    'bank_transfer'
];

// Fill transaction details
$transaction = [
    'enabled_payments' => $enable_payments,
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
        <pre>
            <div id="result-json">JSON result will appear here after payment:<br></div>
        </pre>

        <!-- TODO: Remove ".sandbox" from script src URL for production environment.
             Also input your client key in "data-client-key" -->
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="CLIENT_KEY_HERE"></script>
        <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
            // SnapToken acquired from previous step
            snap.pay('<?= $snapToken ?>', {
                // Optional
                onSuccess: function(result){
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onPending: function(result){
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onError: function(result){
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
        </script>
    </body>
</html>
