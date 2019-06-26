<?php

namespace G4NReact\MsCatalog;

/**
 * Class AbstractFactory
 * @package G4NReact\MsCatalog
 */
abstract class AbstractFactory
{
    /**
     * @param Config $config
     * @return mixed
     */
    public static abstract function create(Config $config);
}
