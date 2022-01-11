<?php
namespace Musti\ForgeApi\PHP;

enum Version {
    
    case PHP_56;
    case PHP_70;
    case PHP_71;
    case PHP_72;
    case PHP_73;
    case PHP_74;
    case PHP_80;
    case PHP_81;

    public function version(): string
    {
        return match($this) 
        {
            Version::PHP_56 => 'php56',
            Version::PHP_70 => 'php70',
            Version::PHP_71 => 'php71',
            Version::PHP_72 => 'php72',
            Version::PHP_73 => 'php73',
            Version::PHP_74 => 'php74',
            Version::PHP_80 => 'php80',
            Version::PHP_81 => 'php81',
        };
    }
}
?>