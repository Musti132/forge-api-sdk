<?php

namespace Musti\ForgeApi\Traits;

use Musti\ForgeApi\Exceptions\BadRequestException;
use Musti\ForgeApi\Exceptions\ForgeOfflineException;
use Musti\ForgeApi\Exceptions\InternalServerErrorException;
use Musti\ForgeApi\Exceptions\InvalidAPIKeyException;
use Musti\ForgeApi\Exceptions\NotFoundException;
use Musti\ForgeApi\Exceptions\TooManyRequestsException;
use Musti\ForgeApi\Exceptions\UnprocessableEntityException;
use Musti\ForgeApi\Forge;
use Musti\ForgeApi\Http\Client;
use Musti\ForgeApi\Http\ClientSingleton;
use ReflectionClass;
use stdClass;

trait DefaultRequests
{
    private Client $client;

    public $response;

    public function __construct() {
        $this->client = ClientSingleton::getClient();
    }

    public function list() : self
    {
        $request = $this->client->get($this->pathName);

        $this->response = $request->getBody();

        return $this;
    }

    public function delete() : self
    {
        $request = $this->client->delete($this->pathName."/");

        $this->response = $request->getBody();

        return $this;
    }

    public function show(int $id = null, bool $asObject = false) : array|stdClass
    {
        $request = $this->client->get($this->pathName."/".$id."/".$this->childPath);

        $this->response = $request->getBody()->getContents();

        return ($asObject) ? $this->toObject() : $this->toArray();
    }

    public function update(array $data)
    {
        // Call Update request
    }

    public function create(array $data)
    {
        // Call Create request
    }

    public function __toString() : string {
        return $this->response;
    }

    public function toObject() : Object {
        return json_decode($this->response);
    }

    public function toArray() : array {
        return json_decode($this->response, true);
    }
}
