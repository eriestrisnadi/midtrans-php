<?php
namespace Lowsprofile\Midtrans\Test;

use Lowsprofile\Midtrans\Methods\Midtrans;

class MidtransTest extends TestCase
{
    public function testSnapToken()
    {
        $params = $this->createData();

        $token = Midtrans::snapToken($params);
        $this->assertTrue($this->isUuid($token));
    }
}
