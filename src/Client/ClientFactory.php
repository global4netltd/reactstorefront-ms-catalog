<?php

namespace G4NReact\MsCatalog\ClientFactory;

use G4NReact\MsCatalog\Config;

/**
 * Class ClientFactory
 * @package G4NReact\MsCatalog\ClientFactory
 */
class ClientFactory
{
    /**
     * @param \G4NReact\MsCatalog\Config $config
     *
     * @return null
     */
    public static function create(Config $config)
    {
        $namespace = $config->getPullerNamespace() ?: null;

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
