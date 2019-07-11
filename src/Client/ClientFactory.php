<?php

namespace G4NReact\MsCatalog\Client;

use Exception;
use G4NReact\MsCatalog\Config as MsCatalogConfig;

/**
 * Class ClientFactory
 * @package G4NReact\MsCatalog\Client
 */
class ClientFactory
{
    /**
     * @param MsCatalogConfig $config
     *
     * @return ClientInterface
     * @throws Exception
     */
    public static function create(MsCatalogConfig $config)
    {
        $namespace = $config->getPusherNamespace() ?: null;

        if (!$namespace) {
            throw new Exception('Namespace is not defined in config.');
        }

        $className = "\\G4NReact\\{$namespace}\\Client\\Client";

        if (class_exists($className)) {
            return new $className($config);
        }

        /** @todo create our client class not found exception */
        throw new Exception(sprintf('Class %s not found.', $className));
    }
}
