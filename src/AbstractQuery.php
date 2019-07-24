<?php

namespace G4NReact\MsCatalog;

use Exception;
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

    /** @var string operator */
    const OPERATOR = 'operator';

    /** @var string OR operator */
    const OR_OPERATOR = 'OR';

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
    public $stats = [];

    /**
     * QueryInterface constructor.
     *
     * @param ConfigInterface $config
     *
     * @throws Exception
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
        $this->client = ClientFactory::getInstance($config);
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
     * @param Field $field
     * @param bool $negative
     * @param string $operator
     *
     * @return $this|mixed
     */
    public function addFilter(Field $field, $negative = false, string $operator = 'AND')
    {
        if ($field->getIndexable() || $field->getType() === Field::FIELD_TYPE_STATIC) {
            $this->filters[$field->getName()] = [
                self::FIELD    => $field,
                self::NEGATIVE => $negative,
                self::OPERATOR => $operator
            ];
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addFilters(array $filters)
    {
        foreach ($filters as $filter) {
            if (isset($filter[0])) {
                $this->addFilter($filter[0], $filter[1] ?? false, $filter[2] ?? 'AND');
            }
        }
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
     * @param $name
     * @return Field|Null
     */
    public function getFilter($name)
    {
        if (isset($this->filters[$name])) {
            return $this->filters[$name];
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function addSort(Field $field)
    {
        if ($field->getIndexable() || $field->getType() === Field::FIELD_TYPE_STATIC) {
            $this->sort[] = $field;
        }
    }

    /**
     * @inheritDoc
     */
    public function setSort(array $fields)
    {
        foreach ($fields as $field) {
            $this->addSort($field);
        }
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
        return $this->pageSize ?: 500;
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
        return $this->pageStart ?: 0;
    }

    /**
     * @inheritDoc
     */
    public function setPageStart(int $pageStart): void
    {
        $this->pageStart = $pageStart;
    }

    /**
     * @param Field $field
     * @param string|null $fieldname
     *
     * @return mixed|void
     */
    public function addFacet(Field $field, ?string $fieldname = null)
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
     * @param Field $statsField
     * @param string $statName
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
