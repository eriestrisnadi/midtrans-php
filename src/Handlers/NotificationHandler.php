<?php
namespace Lowsprofile\Midtrans\Handlers;

use Lowsprofile\Midtrans\Methods\Method;

class NotificationHandler
{
    /**
    * Private static for response
    */
    private static $response;

    /**
    * Construct new instance
    * @return self
    */
    public function __construct()
    {
        $raw_notification = json_decode(file_get_contents('php://input'), true);
        $status_response = Method::status($raw_notification['transaction_id']);
        self::$response = $status_response;
    }
    
    /**
    * Getters
    * @return self or self::$response
    */
    public function __get($name)
    {
        if (array_key_exists($name, self::$response)) {
            return self::$response->$name;
        }
    }
}
