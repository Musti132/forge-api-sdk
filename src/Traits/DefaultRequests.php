<?php

namespace Musti\ForgeApi\Traits;

use Musti\ForgeApi\Forge;
use Musti\ForgeApi\Http\Client;
use Musti\ForgeApi\Http\ClientFactory;
use ReflectionClass;

trait DefaultRequests
{
    protected $client;

    public $response;

    public function __construct() {
        $this->client = ClientFactory::getClient();
    }

    public function list()
    {
        $request = $this->client->get($this->pathName);

        $this->response = $request->getBody();

        return $this;
    }

    public function delete()
    {
        $request = $this->client->delete($this->pathName."/");

        $this->response = $request->getBody();

        return $this;
    }

    public function show(int $id = null)
    {
        $request = $this->client->get($this->pathName."/".$id."/".$this->childPath);

        $this->response = $request->getBody();

        return $this;
    }

    public function update(array $data)
    {
        // Call Update request
    }

    public function create(array $data)
    {
        // Call Create request
    }

    public function __toString() {
        return $this->response;
    }
}
