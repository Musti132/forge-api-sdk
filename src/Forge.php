<?php

namespace Musti\ForgeApi;

use Musti\ForgeApi\Http\Client;
use Musti\ForgeApi\Server\Server;
use Musti\ForgeApi\User\User;
use ReflectionClass;

class Forge
{

    /**
     * Create factory object, and load HttpClient
     * 
     * @param string $apiKey
     * @param array $options Options for guzzlehttp client
     */
    public function __construct(string $apiKey, array $options = []) {
        Factory::init($apiKey, $options);
    }
    /**
     * Get authenticated user information
     * 
     * @return Musti\ForgeApi\User\User;
     */
    public function me()
    {
        $user = new User();

        return $user->me();
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
