<?php

namespace G4NReact\MsCatalog;

/**
 * Interface QueryInterface
 */
interface QueryInterface
{
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
     * @return void
     */
    public function addFilter($filter, $value, $negative = false);

    /**
     * @param $filter
     * @param $value
     * @return void
     */
    public function addFilters($filters);

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
     * Remove sort by field from query
     * @param string $field field name
     * @return void
     */
    public function removeSort(string $field);

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
     * @param string $field
     * @return void
     */
    public function removeFieldFromSelect(string $field);

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
     * Build query and return instance of data which is
     * matching to engine connecting library
     * @return mixed
     */
    public function buildQuery();

}
