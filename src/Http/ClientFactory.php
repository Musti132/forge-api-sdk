<?php
namespace Musti\ForgeApi\Http;

class ClientFactory {
    public static $client;

    public static function createClient(string $apiKey, array $options = []) {
        self::$client = new Client($apiKey, $options);
    }

    public static function getClient() {
        return self::$client;
    }
    
}
?>