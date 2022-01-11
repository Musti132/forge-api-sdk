<?php
namespace Musti\ForgeApi\Http;

use Musti\ForgeApi\Http\HasRequests;
use GuzzleHttp\Client as HttpClient;

class Client {
    use HasRequests;

    private string $baseUri = "https://forge.laravel.com/api/v1/";
    
    public string $apiKey;
    protected array $options;

    protected HttpClient $client;

    public function __construct(string $apiKey, array $options = [])
    {
        $this->setApiKey($apiKey);
        $this->options = $this->options ?? $options;

        $this->setupClient();

        return;
    }

    public function setApiKey(string $apiKey) {
        $this->apiKey = $apiKey;
    }

    public function setupClient(){
        return $this->client = new HttpClient([
            'base_uri' => $this->baseUri,
            'http_errors' => false,
            'headers' => [
                'Authorization' => 'Bearer '.$this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }
}
?>