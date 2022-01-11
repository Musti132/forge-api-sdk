<?php
namespace Musti\ForgeApi\Http;

trait HasRequests {

    public function post(string $path, array $options = []) {
        return $this->client->post($path, $options);
    }

    public function get(string $path) {
        return $this->client->get($path);
    }

    public function delete(string $path) {
        return $this->client->delete($path);
    }
}
?>