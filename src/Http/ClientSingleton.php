<?php
namespace Musti\ForgeApi\Http;

class ClientSingleton {

    private static ?Client $client = null;

    /**
     * 
     * @param string $apiKey
     * @param array $options
     * 
     * @return Musti\ForgeApi\Http\Client
     */
    public static function createClient(string $apiKey, array $options = []) : Client {
        if(self::$client === null) {
            self::$client = new Client($apiKey, $options);
        }

        return self::$client;
    }

    public static function getClient() : Client {
        return self::$client;
    }
}
?>