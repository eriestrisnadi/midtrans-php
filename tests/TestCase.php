<?php
namespace Lowsprofile\Midtrans\Test;

use AspectMock\Test as AspectMock;
use Mockery;
use Lowsprofile\Midtrans\Methods\Method;

class TestCase extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        Method::$server_key = '62b15a7d-e5f8-4b3c-9eab-ca827ca37f55';
        Method::$is_production = false;
    }

    protected function tearDown()
    {
        parent::tearDown();
        self::skipIfHhvm();

        if (!self::isHhvm()) {
            AspectMock::clean();
        }
        Mockery::close();
    }
    
    protected function skipIfHhvm()
    {
        if (self::isHhvm()) {
            $this->markTestSkipped('Skipping test that cannot run on HHVM');
        }
    }

    protected static function isHhvm()
    {
        return defined('HHVM_VERSION');
    }

    protected static function isUuid($value)
    {
        $uuid = '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';
        return (boolean) preg_match($uuid, $value);
    }

    protected static function createData()
    {
        return [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => 10000
            ]
        ];
    }

    public function testToken()
    {
        $token = Method::token();
        $this->assertTrue(is_object($token));
    }

    public function testStatus()
    {
        $status = Method::status(12);
        $this->assertTrue(is_object($status));
    }

    public function testApprove()
    {
        $approve = Method::approve(12);
        $this->assertTrue(is_object($approve));
    }

    public function testDeny()
    {
        $deny = Method::deny(12);
        $this->assertTrue(is_object($deny));
    }

    public function testCancel()
    {
        $cancel = Method::cancel(12);
        $this->assertTrue(is_object($cancel));
    }

    public function testExpire()
    {
        $expire = Method::expire(12);
        $this->assertTrue(is_object($expire));
    }

    public function testRefund()
    {
        $refund = Method::refund(12);
        $this->assertTrue(is_object($refund));
    }

    public function testB2b()
    {
        $b2b = Method::b2b(12);
        $this->assertTrue(is_object($b2b));
    }

    public function testCard()
    {
        $card = Method::card();
        $this->assertTrue(is_object($card));
    }

    public function testBalance()
    {
        $balance = Method::balance();
        $this->assertTrue(is_object($balance));
    }
}
