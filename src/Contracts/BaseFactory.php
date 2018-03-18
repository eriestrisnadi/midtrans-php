<?php
namespace Lowsprofile\Midtrans\Contracts;

interface BaseFactory
{
    public static function status($order_id);
    public static function approve($order_id);
    public static function deny($order_id);
    public static function cancel($order_id);
    public static function expire($order_id);
    public static function refund($order_id);
    public static function b2b($order_id);
    public static function card();
    public static function balance();
}
