<?php
namespace Musti\ForgeApi;

use Musti\ForgeApi\Http\Client;

class Forge {
    public string $apiKey;
    
    public function __construct(string $apiKey, array $options) {
        $this->apiKey = $apiKey;
    }

    public function me() {
        return $this->client = new Client();
    }
}

?>