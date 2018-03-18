<?php
namespace Lowsprofile\Midtrans\Contracts;

interface MidtransFactory extends BaseFactory
{
    public static function snapToken($data);
}
