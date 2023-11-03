<?php
namespace Musti\ForgeApi;

use Musti\ForgeApi\Http\Client;
use Musti\ForgeApi\Http\ClientSingleton;

Class Factory {
    /**
     * Initialize HttpClient with guzzle
     * 
     * @param string $apiKey
     * @param array $options
     * 
     * @return Musti\ForgeApi\Http\Client
     */
    public static function createHttpClient(string $apiKey, array $httpOptions = []): Client {
        return ClientSingleton::createClient($apiKey, $httpOptions);
    }
}

?>