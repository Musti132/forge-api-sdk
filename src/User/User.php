<?php
namespace Musti\ForgeApi\User;

use Musti\ForgeApi\Http\ClientFactory;
use Musti\ForgeApi\Traits\DefaultRequests;

class User {
    use DefaultRequests;

    protected $pathName = "user";

    public function me() {
        $this->client = ClientFactory::getClient();
        
        return $this->show();
    }
}

?>