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
     * @return ClientInterface
     */
    static function create(Config $config)
    {
        $namespace = $config->getPusherNamespace() ?: null;

        if (!$namespace) {
            throw \Exception('Namespace is not defined in config.');
        }

        $className = "\\G4NReact\\{$namespace}\\Client\\Client";

        if (class_exists($className)) {
            return new $className($config);
        }

        /** @todo create our client class not found exception */
        throw \Exception(sprintf('Class %s not found.', $className));
    }
}
