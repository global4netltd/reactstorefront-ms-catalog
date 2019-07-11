<?php

namespace G4NReact\MsCatalog;

use G4NReact\MsCatalog\Client\ClientFactory;

/**
 * Class QueryAbstract
 * @package G4NReact
 */
abstract class AbstractQuery implements \G4NReact\MsCatalog\QueryInterface
{
    /**
     * @var ConfigInterface
     */
    public $config;

    /**
     * @var string
     */
    public $queryText;

    /**
     * @var array
     */
    public $filters;

    /**
     * @var array
     */
    public $sort;

    /**
     * @var array
     */
    public $fields;

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
    public $facets;

    /**
     * @var array
     */
    public $stats;

    /**
     * QueryInterface constructor.
     *
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * @return Client\ClientInterface
     */
    public function getClient()
    {
        return ClientFactory::create($this->config);
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
        return $this->queryText ?? '';
    }

    /**
     * @inheritDoc
     */
    public function addFilter($filter, $value, $negative = false)
    {
        $this->filters[$filter] = [
            'value' => $value,
            'negative' => false
        ];
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
    public function addFieldToSelect(string $field)
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
     * @param array $facet
     * @param $field
     *
     * @return mixed|void
     */
    public function addFacet($facet, $field)
    {
        $this->facets[$facet] = $field;
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
     * @param string $statsField
     *
     * @return mixed|void
     */
    public function addStat(string $statsField)
    {
        $this->stats [] = $statsField;
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
