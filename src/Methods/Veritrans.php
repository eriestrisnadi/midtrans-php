<?php
namespace Lowsprofile\Midtrans\Methods;

use Lowsprofile\Midtrans\Contracts\VeritransFactory;

class Veritrans extends Method implements VeritransFactory
{
    /**
    * Perform a transaction with various available payment methods and features
    * @param array $body
    */
    public static function charge($body)
    {
        $endpoint = parent::baseUrl() . 'charge';
        return parent::clientRequest($endpoint, 'POST', $body);
    }

    /**
    * Capture an authorized transaction for card payment
    * @param array $body
    */
    public static function capture($body)
    {
        $endpoint = parent::baseUrl() . 'capture';
        return parent::clientRequest($endpoint, 'POST', $body);
    }
}
