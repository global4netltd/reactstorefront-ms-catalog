<?php

namespace G4NReact\MsCatalog;

use Exception;
use G4NReact\MsCatalog\Client\ClientFactory;
use G4NReact\MsCatalog\Config;
use G4NReact\MsCatalog\PusherInterface;
use G4NReact\MsCatalog\PullerInterface;
use Iterator;

/**
 * Class Indexer
 * @deprecated since 2019-08-07 (Whole module is deprecated)
 * @package G4NReact\MsCatalogIndexer
 */
class Indexer
{
    /**
     * @var PullerInterface
     */
    protected $puller;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var PusherInterface
     */
    protected $pusher;

    /**
     * Indexer constructor
     *
     * @param Iterator|PullerInterface $puller
     * @param Config $config
     * @throws Exception
     */
    public function __construct(
        PullerInterface $puller,
        Config $config
    ) {
        $this->puller = $puller;
        $this->config = $config;

        $this->pusher = ClientFactory::create($config)->getPusher();
    }

    /**
     * @return void
     */
    public function reindex()
    {
        if ($this->puller && $this->pusher) {
            $this->pusher->push($this->puller);
        }
    }
}
