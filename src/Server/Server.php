<?php

namespace Musti\ForgeApi\Server;

use Musti\ForgeApi\Database\ManageDatabase;
use Musti\ForgeApi\Database\ManageDatabaseUsers;
use Musti\ForgeApi\Interfaces\RequestInterface;
use Musti\ForgeApi\PHP\ManagePhpVersion;
use Musti\ForgeApi\Traits\DefaultRequests;

class Server implements RequestInterface
{
    use DefaultRequests,
        ManagePhpVersion,
        ManageDatabase,
        ManageDatabaseUsers;

    private $pathName = "servers";
    
    protected $id;
    protected $siteId;

    /**
     * Change database password of a server.
     * 
     * @param string $password Password to change to
     */
    public function updateDbPassword(string $password)
    {
        $request = $this->client->put($this->pathName . "/" . $this->serverId);

        $this->response = $request->getBody();

        return $this;
    }

    /**
     * Register server id to be used for later methods.
     * 
     * @param int $id
     * 
     * @return Musti\ForgeApi\Server\Server
     */
    public function setServerId(int $id)
    {
        $this->serverId = $id;

        return $this;
    }

    /**
     * Register site id to be used for later methods.
     * 
     * @param int $id
     * 
     * @return Musti\ForgeApi\Server\Server
     */
    public function setSiteId(int $id)
    {
        $this->siteId = $id;

        return $this;
    }

    /**
     * Reboots a server
     * 
     * @return Musti\ForgeApi\Server\Server
     */
    public function reboot()
    {
        $request = $this->client->post($this->pathName . "/" . $this->serverId . '/reboot', []);

        $this->response = $request->getBody();

        if ($request->getStatusCode() == 200) {
            $this->response = json_encode([
                'status' => 'success',
                'message' => 'Server rebooted',
            ]);
        }

        return $this;
    }

    /**
     * Delete a server from endpoint
     * 
     * @return Musti\ForgeApi\Server\Server
     */
    public function deleteServer() {
        $request = $this->client->delete($this->pathName . "/" . $this->serverId, []);

        $this->response = $request->getBody();

        if ($request->getStatusCode() == 200) {
            $this->response = json_encode([
                'status' => 'success',
                'message' => 'Server rebooted',
            ]);
        }

        return $this;
    }
}
