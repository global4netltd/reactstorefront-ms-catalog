<?php

namespace G4NReact\MsCatalog;

use G4NReact\MsCatalog\Client\ClientFactory;
use G4NReact\MsCatalog\Document\Field;

/**
 * Class QueryAbstract
 * @package G4NReact
 */
abstract class AbstractQuery implements QueryInterface
{
    /** @var string field */
    const FIELD = 'field';
    
    /** @var string negative */
    const NEGATIVE = 'negative';
    
    /**
     * @var ConfigInterface
     */
    public $config;

    /**
     * @var ClientInterface
     */
    public $client;
    
    /**
     * @var string
     */
    public $queryText;

    /**
     * @var array
     */
    public $filters = [];

    /**
     * @var array
     */
    public $sort;

    /**
     * @var array
     */
    public $fields = [];
    
    /**
     * @var int
     */
    public $pageSize;

    /**
     * @var int
     */
    public $pageStart;

    /**
     * @var array
     */
    public $additionalOptions;

    /**
     * @var array
     */
    public $facets = [];

    /**
     * @var array
     */
    public $stats;

    /**
     * QueryInterface constructor.
     *
     * @param ConfigInterface $config
     * @param ClientInterface $client
     */
    public function __construct(ConfigInterface $config, ClientInterface $client)
    {
        $this->config = $config;
        $this->client = $client;
    }

    /**
     * @return Client\ClientInterface
     * @throws Exception
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @inheritDoc
     */
    public function setQueryText($queryText)
    {
        $this->queryText = $queryText;
    }

    /**
     * @inheritDoc
     */
    public function getQueryText()
    {
        return $this->queryText;
    }

    /**
     * @param \G4NReact\MsCatalog\Document\Field $field
     * @param bool $negative
     *
     * @return mixed|void
     */
    public function addFilter(Field $field, $negative = false)
    {
        $this->filters[$field->getName()] = [
            self::FIELD => $field,
            self::NEGATIVE => $negative
        ];
        
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addFilters($filters)
    {
        $this->filters = array_merge($this->filters, $filters);
    }

    /**
     * @inheritDoc
     */
    public function clearFilters()
    {
        $this->filters = [];
    }

    /**
     * @inheritDoc
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @inheritDoc
     */
    public function addSort($field, $direction)
    {
        $this->sort[] = [$field, $direction];
    }

    /**
     * @inheritDoc
     */
    public function setSort(array $fields)
    {
        $this->sort = $fields;
    }

    /**
     * @inheritDoc
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @inheritDoc
     */
    public function clearSort()
    {
        $this->sort = [];
    }

    /**
     * @inheritDoc
     */
    public function addFieldToSelect(Field $field)
    {
        $this->fields[] = $field;
    }

    /**
     * @inheritDoc
     */
    public function addFieldsToSelect(array $fields)
    {
        $this->fields = array_merge($this->fields, $fields);
    }

    /**
     * @inheritDoc
     */
    public function clearFieldsInSelect()
    {
        $this->fields = [];
    }

    /**
     * @inheritDoc
     */
    public function setAdditionalOptions(array $options)
    {
        $this->additionalOptions = $options;
    }


    /**
     * @inheritDoc
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }


    /**
     * @inheritDoc
     */
    public function setPageSize(int $pageSize): void
    {
        $this->pageSize = $pageSize;
    }


    /**
     * @inheritDoc
     */
    public function getPageStart(): int
    {
        return $this->pageStart;
    }


    /**
     * @inheritDoc
     */
    public function setPageStart(int $pageStart): void
    {
        $this->pageStart = $pageStart;
    }

    /**
     * @param \G4NReact\MsCatalog\Document\Field $field
     * @param null|string $fieldname
     *
     * @return mixed|void
     */
    public function addFacet(Field $field, $fieldname = null)
    {
        $this->facets[$fieldname ?? $field->getName()] = $field;
    }

    /**
     * @param array $facets
     *
     * @return mixed|void
     */
    public function addFacets(array $facets)
    {
        $this->facets = array_merge($this->facets, $facets);
    }

    /**
     * @return mixed
     */
    public function getFacets()
    {
        return $this->facets;
    }

    /**
     * @param \G4NReact\MsCatalog\Document\Field $statsField
     * @param string|null $statName
     *
     * @return mixed|void
     */
    public function addStat(Field $statsField, string $statName = null)
    {
        $this->stats[$statName ?? $statsField->getName()] = $statsField;
    }

    /**
     * @param array $stats
     *
     * @return mixed|void
     */
    public function addStats(array $stats)
    {
        $this->stats = array_merge($this->stats, $stats);
    }

    /**
     * @return mixed
     */
    public function getStats()
    {
        return $this->stats;
    }

    /**
     * @inheritDoc
     */
    abstract public function buildQuery();

    /**
     * @inheritDoc
     */
    abstract public function getResponse();

}
