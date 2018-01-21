<?php

namespace App;

class Message
{
    private static $_instance = null;
    private static $_client = null;

    public static $localsocket = 'tcp://127.0.0.1:1234';

    /**
     * @return Singleton
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self;
        }

        if (null === self::$_client) {
            self::$_client = stream_socket_client(self::$localsocket);
        }
        return self::$_instance;
    }

    public static function send($message, $user_id = null) {

        fwrite(self::getInstance(), json_encode(['user' => $user_id, 'message' => $message])  . "\n");
    }


    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}