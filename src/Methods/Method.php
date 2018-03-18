<?php
namespace Lowsprofile\Midtrans\Methods;

use Exception;
use GuzzleHttp\Client;

class Method
{
    /**
    * Set server key of api
    */
    public static $server_key;

    /**
    * Set type of target api
    */
    public static $is_production;

    /**
    * $is_production is false, core target endpoint will use this
    */
    protected static $sandbox_base_url = 'https://api.sandbox.midtrans.com/v2/';

    /**
    * $is_production is true, core target endpoint will use this
    */
    protected static $production_base_url = 'https://api.midtrans.com/v2/';

    /**
    * Construct new instance
    * @return self
    */
    public function __construct($server_key, $is_production)
    {
        self::$server_key = $server_key;
        self::$is_production = $is_production;
    }

    /**
    * Get base url based on protected variable
    * @return string
    */
    public static function baseUrl()
    {
        return (self::$is_production) ? self::$production_base_url : self::$sandbox_base_url;
    }

    /**
    * Generete Http Request Header
    * @return array
    */
    public static function header()
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode(self::$server_key. ':')
        ];
    }

    /**
    * Generate Http Request to the api
    * @param string $url
    * @param string $type
    * @param array $data
    * @return object $body or throw an exception
    */
    public static function clientRequest($url, $type, $data = null)
    {
        try {
            $client = new Client();
            $response = $client->request($type, $url, [
                'headers' => self::header(),
                'verify' => dirname(__FILE__) . '/../cert/cacert.pem',
                'json' => $data
            ]);
            
            $body = json_decode((string) $response->getBody());

            if (isset($body->status_code) && $body->status_code === '401') {
                throw new Exception($body->status_message, $body->status_code);
            }

            return $body;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
    * Tokenize Credit Card information before being charged
    * @return object
    */
    public static function token()
    {
        $endpoint = self::baseUrl() . 'token';
        return self::clientRequest($endpoint, 'GET');
    }

    /**
    * Get information status of a transaction
    * @param string $id => order_id or transaction_id
    * @return object
    */
    public static function status($id)
    {
        $endpoint = self::baseUrl() . $id . '/status';
        return self::clientRequest($endpoint, 'GET');
    }

    /**
    * Cancel transaction before it's settled
    * @param string $id => order_id or transaction_id
    * @return object
    */
    public static function approve($id)
    {
        $endpoint = self::baseUrl() . $id . '/approve';
        return self::clientRequest($endpoint, 'POST');
    }

    /**
    * Deny transaction before it's settled
    * @param string $id => order_id or transaction_id
    * @return object
    */
    public static function deny($id)
    {
        $endpoint = self::baseUrl() . $id . '/deny';
        return self::clientRequest($endpoint, 'POST');
    }

    /**
    * Cancel transaction before it's settled
    * @param string $id => order_id or transaction_id
    * @return object
    */
    public static function cancel($id)
    {
        $endpoint = self::baseUrl() . $id . '/cancel';
        return self::clientRequest($endpoint, 'POST');
    }

    /**
    * Expire transaction before it's settled
    * @param string $id => order_id or transaction_id
    * @return object
    */
    public static function expire($id)
    {
        $endpoint = self::baseUrl() . $id . '/expire';
        return self::clientRequest($endpoint, 'POST');
    }

    /**
    * Refund transaction before it's settled
    * @param string $id => order_id or transaction_id
    * @return object
    */
    public static function refund($id)
    {
        $endpoint = self::baseUrl() . $id . '/refund';
        return self::clientRequest($endpoint, 'POST');
    }

    /**
    * Get information status of multiple B2B transactions
    * @param string $id => order_id or transaction_id
    * @return object
    */
    public static function b2b($id)
    {
        $endpoint = self::baseUrl() . $id . '/status/b2b';
        return self::clientRequest($endpoint, 'GET');
    }

    /**
    * Register card information (card number and expiry) to be used for two clicks and one click
    * @return object
    */
    public static function card()
    {
        $endpoint = self::baseUrl() . 'card/register';
        return self::clientRequest($endpoint, 'GET');
    }

    /**
    * Get the point balance of the card in denomination amount
    * @return object
    */
    public static function balance()
    {
        $endpoint = self::baseUrl() . 'point_inquiry/token_id';
        return self::clientRequest($endpoint, 'GET');
    }
}
