<?php
namespace Lowsprofile\Midtrans\Test;

use Lowsprofile\Midtrans\Methods\Veritrans;

class VeritransTest extends TestCase
{
    public function testCharge()
    {
        $params = array_merge($this->createData(), [
            'payment_type' => 'bank_transfer',
            'bank_transfer' => [
                'bank' => 'permata'
            ]
        ]);

        $charge = Veritrans::charge($params);
        $this->assertTrue(is_object($charge));
    }

    public function testCapture()
    {
        $params = [
            'transaction_id' => 'be4f3e44-d6ee-4355-8c64-c1d1dc7f4590',
            'gross_amount' => 145000
        ];

        $capture = Veritrans::capture($params);
        $this->assertTrue(is_object($capture));
    }
}
