<?php

namespace G4NReact\MsCatalog;

/**
 * Class PullerFactory
 * @package G4NReact\MsCatalog
 */
class PullerFactory extends AbstractFactory
{
    /**
     * @param Config $config
     * @return null|PullerInterface
     */
    public static function create(Config $config)
    {
        $namespace = $config->getPullerNamespace() ?: null;

        if (!$namespace) {
            return null;
        }

        $className = "\\G4NReact\\{$namespace}\\Puller";

        if (class_exists($className)) {
            return new $className($config);
        }

        return null;
    }
}
