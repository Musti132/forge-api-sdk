<?php
namespace Musti\ForgeApi\Http;

class ClientFactory {

    /**
     * 
     * @param string $apiKey
     * @param array $options
     * 
     * @return Musti\ForgeApi\Http\Client
     */
    public static function createClient(string $apiKey, array $options = []) : Client {
        return new Client($apiKey, $options)
    }
}
?>