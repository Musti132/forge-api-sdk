<?php
namespace Musti\ForgeApi\Api;

class ApiFactory {
    public static $apiKey;

    public static function setApiKey(string $apiKey) {
        self::$apiKey = $apiKey;
    }
}
?>