<?php

namespace G4NReact\MsCatalog\Client;

use Exception;
use G4NReact\MsCatalog\ConfigInterface;

/**
 * Class ClientFactory
 * @package G4NReact\MsCatalog\Client
 */
class ClientFactory
{

    protected static $instance = null;

    /**
     * @param ConfigInterface $config
     * @return ClientInterface
     * @throws Exception
     */
    public static function create(ConfigInterface $config)
    {
        $namespace = $config->getEngineNamespace() ?: null;

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

    /**
     * @param ConfigInterface $config
     * @param int $id
     *
     * @return ClientInterface
     * @throws Exception
     */
    public static function getInstance(ConfigInterface $config, int $id = 0)
    {
        if(self::$instance[$id] == null){
            self::$instance[$id] = ClientFactory::create($config);
        }

        return self::$instance[$id];
    }
}
