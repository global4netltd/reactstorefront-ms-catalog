<?php

namespace G4NReact\MsCatalog;

/**
 * Class Helper
 * @package G4NReact\MsCatalog
 */
class Helper
{
    /**#@+
     * Engine types
     */
    const ENGINE_SOLR_VALUE = 1;
    const ENGINE_SOLR_NAMESPACE = 'MsCatalogSolr';
    const ENGINE_SOLR_LABEL = 'Solr';
    const ENGINE_SOLR_CODE = 'solr';

    const ENGINE_ELASTICSEARCH_VALUE = 2;
    const ENGINE_ELASTICSEARCH_NAMESPACE = 'MsCatalogElasticsearch';
    const ENGINE_ELASTICSEARCH_LABEL = 'Elasticsearch';
    const ENGINE_ELASTICSEARCH_CODE = 'elasticsearch';
    /**#@- */

    /**
     * @var array Engines params
     */
    public static $engines = [
        self::ENGINE_SOLR_VALUE => [
            'engine' => self::ENGINE_SOLR_VALUE,
            'namespace' => self::ENGINE_SOLR_NAMESPACE,
            'label' => self::ENGINE_SOLR_LABEL,
            'code' => self::ENGINE_SOLR_CODE,
            'connection' => [
                'host',
                'port',
                'core',
                'collection',
            ],
        ],
        self::ENGINE_ELASTICSEARCH_VALUE => [
            'engine' => self::ENGINE_ELASTICSEARCH_VALUE,
            'namespace' => self::ENGINE_ELASTICSEARCH_NAMESPACE,
            'label' => self::ENGINE_ELASTICSEARCH_LABEL,
            'code' => self::ENGINE_ELASTICSEARCH_CODE,
            'connection' => [
                'host',
                'port',
            ],
        ],
    ];

    /**
     * @var array
     */
    public static $coreDocumentFieldsNames = [
        'unique_id',
        'id',
        'object_type',
        'score',
    ];
}
