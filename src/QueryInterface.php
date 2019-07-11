<?php

namespace G4NReact\MsCatalog;

use G4NReact\MsCatalog\Client\ClientInterface;

/**
 * Interface QueryInterface
 */
interface QueryInterface
{
    /**
     * QueryInterface constructor.
     * @param ConfigInterface $config
     * @param ClientInterface $client
     */
    public function __construct(ConfigInterface $config, ClientInterface $client);

    /**
     * @param mixed $queryText
     * @return void
     */
    public function setQueryText($queryText);

    /**
     * @return mixed
     */
    public function getQueryText();

    /**
     * @param string $filter
     * @param mixed $value set value for filter which could be also range (X-Y)
     * @param bool $negative defines if value must not appear in data
     * @return $this
     */
    public function addFilter($filter, $value, $negative = false);

    /**
     * @param array $filters
     * @return $this
     */
    public function addFilters(array $filters);

    /**
     * @return void
     */
    public function clearFilters();

    /**
     * @return mixed
     */
    public function getFilters();

    /**
     * @param $field
     * @param $direction
     * @return void
     */
    public function addSort($field, $direction);

    /**
     * Replace current sort fields with new one
     * Array should be build in field => direction convention
     * @param array $fields
     * @return void
     */
    public function setSort(array $fields);

    /**
     * @return mixed
     */
    public function getSort();

    /**
     * Clear all current set sort in query
     * @return void
     */
    public function clearSort();

    /**
     * @param string $field
     * @return void
     */
    public function addFieldToSelect(string $field);

    /**
     * @param array $fields
     * @return void
     */
    public function addFieldsToSelect(array $fields);

    /**
     * @return void
     */
    public function clearFieldsInSelect();

    /**
     * @param array $options
     * @return mixed
     */
    public function setAdditionalOptions(array $options);

    /**
     * @return int
     */
    public function getPageSize(): int;

    /**
     * @param int $pageSize
     */
    public function setPageSize(int $pageSize): void;

    /**
     * @return int
     */
    public function getPageStart(): int;

    /**
     * @param int $pageStart
     */
    public function setPageStart(int $pageStart): void;

    /**
     * @param array $facet
     *
     * @return mixed
     */
    public function addFacet($facet, $field);
    /**
     * @param array $facets
     *
     * @return mixed
     */
    public function addFacets(array $facets);

    /**
     * @return mixed
     */
    public function getFacets();

    /**
     * @param string $statsField
     *
     * @return mixed
     */
    public function addStat(string $statsField);
    /**
     * @param array $stats
     *
     * @return mixed
     */
    public function addStats(array $stats);

    /**
     * @return mixed
     */
    public function getStats();

    /**
     * Build query and return instance of data which is
     * matching to engine library
     * @return mixed
     */
    public function buildQuery();

    /**
     * Run query and get response (@return Response
     * @see Response) from
     * selected engine library
     */
    public function getResponse();

}
