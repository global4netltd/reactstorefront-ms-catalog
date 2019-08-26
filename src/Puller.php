<?php

namespace G4NReact\MsCatalog;

use G4NReact\MsCatalogSolr\Puller as SolrPuller;
use G4NReact\MsCatalogSolr\QueryBuilder;
use G4NReact\MsCatalogSolr\Response; // @ToDo move Response to ms-catalog
use G4NReact\MsCatalogIndexer\Config; // @ToDo: move Config to ms-catalog
use G4NReact\MsCatalogSolr\Config as SolrConfig;

class Puller
{
    /**
     * Engine types
     */
    const ENGINE_SOLR = 1;

    /**
     * @var Query
     */
    protected $query;

    /**
     * @var QueryBuilderInterface
     */
    protected $queryBuilder;
    
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var SolrPuller|mixed
     */
    protected $puller;

    /**
     * Puller constructor.
     * @param Config $config
     */
    public function __construct(
        Config $config
    ) {
        $this->config = $config;

        $this->init();
    }

    /**
     *
     */
    protected function init()
    {
        if ($engine = $this->config->getEngine()) {
            switch($engine) {
                case self::ENGINE_SOLR:
                    $config = $this->createSolrConfig();
                    $this->puller = new SolrPuller($config);
                    $this->queryBuilder = new QueryBuilder();
            }
        }
    }

    /**
     * @return SolrConfig
     */
    protected function createSolrConfig(): SolrConfig
    {
        $host = $this->config->getHost();
        $port = $this->config->getPort();
        $path = $this->config->getPath();
        $collection = $this->config->getCollection();
        $core = $this->config->getCore();

        return new SolrConfig($host, $port, $path, $collection, $core);
    }

    /**
     * @return QueryBuilderInterface
     */
    public function getQueryBuilder()
    {
        return $this->queryBuilder;
    }

    /**
     * @param QueryInterface $query
     * @return Response
     */
    public function pull(QueryInterface $query)
    {
        $response = new Response();

        if ($query && $this->puller) {
            $response = $this->puller->pull($query);
        }

        return $response;
    }
}
