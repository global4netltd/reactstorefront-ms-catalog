<?php

namespace G4NReact\MsCatalog\Client;

use G4NReact\MsCatalog\Config;

/**
 * Class ClientFactory
 * @package G4NReact\MsCatalog\Client
 */
class ClientFactory
{
    /**
     * @param \G4NReact\MsCatalog\Config $config
     *
     * @return null
     */
    public function create(Config $config)
    {
        $namespace = $config->getPusherNamespace() ?: null;

        if (!$namespace) {
            return null;
        }

        $className = "\\G4NReact\\{$namespace}\\Client\\Client";

        if (class_exists($className)) {
            return new $className($config);
        }

        return null;
    }
}
