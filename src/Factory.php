<?php
namespace Musti\ForgeApi;

use Musti\ForgeApi\Api\ApiFactory;
use Musti\ForgeApi\Http\ClientFactory;

Class Factory {
    public static $instance = null;

    /**
     * @param string $apiKey
     * @param array $options
     * 
     */
    public static function init(string $apiKey, array $options = []): self {
        if(self::$instance == null) {
            self::$instance = new self;
        }
        
        self::createHttpClient($apiKey, $options);
        self::setApikey($apiKey);

        return self::$instance;
    }

    /**
     * Initialize HttpClient with guzzle
     * 
     * @param string $apiKey
     * @param array $options
     * 
     */
    public static function createHttpClient(string $apiKey, array $options = []): void {
        ClientFactory::createClient($apiKey, $options);
    }

    /**
     * Set Api Key to be used for client.
     * 
     * @param string $apiKey
     * 
     */
    public static function setApiKey(string $apiKey): void {
        ApiFactory::setApiKey($apiKey);
    }
}

?>