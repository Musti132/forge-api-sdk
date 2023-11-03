<?php
namespace Musti\ForgeApi\Http;

use Musti\ForgeApi\Exceptions\BadRequestException;
use Musti\ForgeApi\Exceptions\ForgeOfflineException;
use Musti\ForgeApi\Exceptions\InternalServerErrorException;
use Musti\ForgeApi\Exceptions\InvalidAPIKeyException;
use Musti\ForgeApi\Exceptions\NotFoundException;
use Musti\ForgeApi\Exceptions\TooManyRequestsException;
use Musti\ForgeApi\Exceptions\UnprocessableEntityException;
use Musti\ForgeApi\Http\HasRequests;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class Client {
    use HasRequests;

    /**
     * Base URI for Forge API
     * 
     * @var string
     */
    private string $baseUri = "https://forge.laravel.com/api/v1/";

    /**
     * API Key for Forge API
     * 
     * @var string
     */
    private string $apiKey;

    /**
     * Options for guzzlehttp client
     * 
     * @var array
     */
    private array $options;

    /**
     * GuzzleHttp Client
     * 
     * @var GuzzleHttp\Client
     */
    private HttpClient $client;

    public function __construct(string $apiKey, array $options = [])
    {
        $this->setApiKey($apiKey);
        $this->options = $this->options ?? $options;

        $this->setupClient();
    }

    public function setApiKey(string $apiKey) {
        $this->apiKey = $apiKey;
    }

    public function setupClient() : HttpClient{
        $this->client = new HttpClient([
            'base_uri' => $this->baseUri,
            'http_errors' => false,
            'headers' => [
                'Authorization' => 'Bearer '.$this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'handler' => $this->getHandlerStack(),
        ]);

        return $this->client;
    }

    public function getHandlerStack() : HandlerStack {
        $stack = HandlerStack::create();

        $stack->push(
            Middleware::mapResponse(
                function (ResponseInterface $response) {
                    $this->handleResponse($response);
                    
                    return $response;
                }
            )
        );

        return $stack;
    }

    /**
     * Handle response from guzzlehttp client
     * 
     * @param GuzzleHttp\Psr7\Response $response
     * 
     * @return void
     */
    public function handleResponse(Response $response) : void
    {
        if($response->getStatusCode() < 200 || $response->getStatusCode() > 299) {
            $this->dispatchErrorForStatusCode($response->getStatusCode());
        }
    }


    /**
     * Throw error based on status code
     * 
     * @param int $code
     * 
     * @return void
     * 
     * @throws Musti\ForgeApi\Exceptions\BadRequestException
     * @throws Musti\ForgeApi\Exceptions\InvalidAPIKeyException
     * @throws Musti\ForgeApi\Exceptions\NotFoundException
     * @throws Musti\ForgeApi\Exceptions\TooManyRequestsException
     * @throws Musti\ForgeApi\Exceptions\UnprocessableEntityException
     * @throws Musti\ForgeApi\Exceptions\InternalServerErrorException
     * @throws Musti\ForgeApi\Exceptions\ForgeOfflineException
     * @throws \Exception
     */
    public function dispatchErrorForStatusCode(int $code) : void
    {
        match($code) {
            400 => throw new BadRequestException("Bad Request"),
            401 => throw new InvalidAPIKeyException("The API key provided is invalid."),
            404 => throw new NotFoundException("The requested resource could not be found."),
            422 => throw new UnprocessableEntityException("Missing or invalid parameters."),
            429 => throw new TooManyRequestsException("Too many requests."),
            500 => throw new InternalServerErrorException("Internal server error."),
            503 => throw new ForgeOfflineException("Forge is offline for maintenance."),
            default => throw new \Exception("Unknown error."),
        };
    }
}
?>