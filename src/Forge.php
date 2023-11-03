<?php

namespace Musti\ForgeApi;

use Musti\ForgeApi\Http\Client;
use Musti\ForgeApi\Server\Server;
use Musti\ForgeApi\User\User;
use ReflectionClass;

class Forge
{
    private Client $client;

    /**
     * Create factory object, and load HttpClient
     * 
     * @param string $apiKey
     * @param array $options Options for guzzlehttp client
     */
    public function __construct(string $apiKey, array $httpOptions = []) {
        $this->client = Factory::createHttpClient($apiKey, $httpOptions);
    }
    /**
     * Get authenticated user information
     * 
     * @return Musti\ForgeApi\User\User;
     */
    public function user(bool $asObject = false) : User
    {
        return new User($asObject);
    }

    public function __call($name, $args): Object
    {
        $className = ucfirst($name);

        if (!file_exists(__DIR__.'/'.$className) && !is_dir(__DIR__.'/'.$className)) {
            trigger_error($className. ' Does not exists', E_USER_ERROR);
        }

        $namespace = __NAMESPACE__.'\\'.$className.'\\';

        $fullNamespace = $namespace.$className;
        /*
        $reflection = new ReflectionClass($fullNamespace);*/
        
        $class = new $fullNamespace(...$args);

        return $class;
    }
}
