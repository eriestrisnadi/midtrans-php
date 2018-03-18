<?php
namespace Lowsprofile\Midtrans\Methods;

use Lowsprofile\Midtrans\Contracts\MidtransFactory;

class Midtrans extends Method implements MidtransFactory
{
    /**
    * parent::$is_production is false, core target endpoint will use this
    */
    private static $snap_sandbox_base_url = 'https://app.sandbox.midtrans.com/snap/v1/';

    /**
    * parent::$is_production is true, core target endpoint will use this
    */
    private static $snap_production_base_url = 'https://app.midtrans.com/snap/v1/';

    /**
    * Get base url snap based on private variable
    * @return string
    */
    private static function snapChargeUrl()
    {
        return (parent::$is_production) ? self::$snap_production_base_url : self::$snap_sandbox_base_url;
    }

    /**
    * Get snap token
    * @param array $body
    */
    public static function snapToken($body)
    {
        $endpoint = self::snapChargeUrl() . 'transactions';
        return parent::clientRequest($endpoint, 'POST', $body)->token;
    }
}
