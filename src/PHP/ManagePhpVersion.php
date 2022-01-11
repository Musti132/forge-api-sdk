<?php
namespace Musti\ForgeApi\PHP;

use Musti\ForgeApi\PHP\Version;

trait ManagePhpVersion {
    /**
     * Install a php version
     * 
     * @param Musti\ForgeApi\PHP\Version $version Php version
     * 
     * @return Object
     */
    public function installPhpVersion(Version $version) {
        $request = $this->client->post($this->pathName."/".$this->serverId.'/php', [
            'form_params' => [
                'version' => $version->version(),
            ],
        ]);

        $this->response = $request->getBody();

        if($request->getStatusCode() == 200) {
            $this->response = json_encode([
                'status' => 'success',
                'message' => 'Php version installed',
            ]);
        }

        return $this;
    }

    /**
     * Upgrade current php version
     * 
     * @param Musti\ForgeApi\PHP\Version $version Php version
     * 
     * @return Object
     */
    public function upgradePhpVersion(Version $version) {
        $request = $this->client->post($this->pathName."/".$this->serverId.'/php/update', [
            'form_params' => [
                'version' => $version->version(),
            ],
        ]);

        $this->response = $request->getBody();

        if($request->getStatusCode() == 200) {
            $this->response = json_encode([
                'status' => 'success',
                'message' => 'Upgraded php version',
            ]);
        }

        return $this;
    }
}
?>