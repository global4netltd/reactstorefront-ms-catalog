<?php

namespace G4NReact;

/**
 * Class QueryAbstract
 * @package G4NReact
 */
class QueryAbstract implements \G4NReact\MsCatalog\QueryInterface
{
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
     * @var array
     */
    public $additionalOptions;


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
    public function buildQuery()
    {
        // TODO: Implement buildQuery() method.
    }

}
