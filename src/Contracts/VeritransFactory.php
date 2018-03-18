<?php
namespace Lowsprofile\Midtrans\Contracts;

interface VeritransFactory extends BaseFactory
{
    public static function charge($data);
    public static function capture($data);
}
