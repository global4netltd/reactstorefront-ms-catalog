<?php

namespace G4NReact\MsCatalog;

use G4NReact\MsCatalog\Document\Field;

/**
 * Interface QueryInterface
 */
interface QueryInterface
{
    /**
     * QueryInterface constructor.
     *
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config);

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
     * @param Field $field
     * @param bool $negative
     *
     * @return mixed
     */
    public function addFilter(Field $field, $negative = false);

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
     * @param $name
     * @return Field|Null
     */
    public function getFilter($name);

    /**
     * @param Field $field
     * @param string $direction
     * @return void
     */
    public function addSort(Field $field, string $direction);

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
    public function addFieldToSelect(Field $field);

    /**
     * @param Field[] $fields
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
     * @param Field $field
     * @param string|null $fieldname
     *
     * @return mixed
     */
    public function addFacet(Field $field, ?string $fieldname = null);

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
     * @param Field $statsField
     * @param string|null $statName
     *
     * @return mixed
     */
    public function addStat(Field $statsField, string $statName = null);
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
     * Run query and get response (@return ResponseInterface
     * @see ResponseInterface) from
     * selected engine library
     */
    public function getResponse();

}
