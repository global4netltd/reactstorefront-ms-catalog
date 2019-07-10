<?php

namespace G4NReact\MsCatalog;

/**
 * Interface QueryInterface
 */
interface QueryInterface
{

    /**
     * @param $queryText
     * @return void
     */
    public function setQueryText($queryText);

    /**
     * @param $filter
     * @param $value
     * @return void
     */
    public function addFilterQuery($filter, $value, $negative = false);

    /**
     * @return void
     */
    public function clearFilterQuery();

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



}
