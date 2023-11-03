<?php
namespace Musti\ForgeApi\User;

use Musti\ForgeApi\Http\ClientSingleton;
use Musti\ForgeApi\Interfaces\RequestInterface;
use Musti\ForgeApi\Traits\DefaultRequests;

class User implements RequestInterface {
    use DefaultRequests;

    /**
     * The path name of the request. Used for DefaultRequests trait.
     * 
     * @var string $pathName
     */
    private $pathName = "user";

    /**
     * The child path of the request. Used for DefaultRequests trait.
     * 
     * @var string $childPath
     */
    private $childPath = "";

    public function me(bool $asObject = false) {
        return $this->show(
            asObject: $asObject
        );
    }
}

?>