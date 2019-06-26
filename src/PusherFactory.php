<?php

namespace G4NReact\MsCatalog;

/**
 * Class PusherFactory
 * @package G4NReact\MsCatalog
 */
class PusherFactory extends AbstractFactory
{
    /**
     * @param Config $config
     * @return null|PusherInterface
     */
    public static function create(Config $config)
    {
        $namespace = $config->getPusherNamespace() ?: null;

        if (!$namespace) {
            return null;
        }

        $className = "\\G4NReact\\{$namespace}\\Pusher";

        if (class_exists($className)) {
            return new $className($config);
        }

        return null;
    }
}
