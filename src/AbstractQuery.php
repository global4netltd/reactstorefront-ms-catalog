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
    /**
     * @var string field
     */
    const FIELD = 'field';

    /**
     * @var string negative
     */
    const NEGATIVE = 'negative';

    /**
     * @var string operator
     */
    const OPERATOR = 'operator';

    /**
     * @var string OR operator
     */
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
    public $queryText = '';

    /**
     * @var array
     */
    public $filters = [];

    /**
     * @var array
     */
    public $sorts = [];

    /**
     * @var array
     */
    public $fields = [];

    /**
     * @var int
     */
    public $pageSize = 500;

    /**
     * @var int
     */
    public $pageStart = 0;

    /**
     * @var array
     */
    public $additionalOptions = [];

    /**
     * @var array
     */
    public $facets = [];

    /**
     * @var array
     */
    public $stats = [];

    /**
     * QueryInterface constructor
     *
     * @param ConfigInterface $config
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
     * @param string $queryText
     * @return QueryInterface
     */
    public function setQueryText($queryText): QueryInterface
    {
        $this->queryText = $queryText;

        return $this;
    }

    /**
     * @return string
     */
    public function getQueryText(): string
    {
        return $this->queryText;
    }

    /**
     * @param Field $field
     * @param bool $negative
     * @param string $operator
     * @return QueryInterface
     */
    public function addFilter(Field $field, $negative = false, string $operator = 'AND'): QueryInterface
    {
        if ($field->getIndexable() || $field->getType() === Field::FIELD_TYPE_STATIC) {
            $this->filters[$field->getName()][] = [
                self::FIELD    => $field,
                self::NEGATIVE => $negative,
                self::OPERATOR => $operator
            ];
        }

        return $this;
    }

    /**
     * @param array $filters
     * @return QueryInterface
     */
    public function addFilters(array $filters): QueryInterface
    {
        foreach ($filters as $filter) {
            if (isset($filter[0])) {
                $this->addFilter($filter[0], $filter[1] ?? false, $filter[2] ?? 'AND');
            }
        }

        return $this;
    }

    /**
     * @return QueryInterface
     */
    public function clearFilters(): QueryInterface
    {
        $this->filters = [];

        return $this;
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        return is_array($this->filters) ? $this->filters : [];
    }

    /**
     * @param string $name
     * @return array
     */
    public function getFilter(string $name, $idx = 0): array
    {
        if (isset($this->filters[$name][$idx])) {
            return $this->filters[$name][$idx];
        }

        return [];
    }

    /**
     * @param Field $field
     * @return QueryInterface
     */
    public function addSort(Field $field): QueryInterface
    {
//        if ($field->getIndexable() || $field->getType() === Field::FIELD_TYPE_STATIC) { @ToDo: Temporarily - 'popularity' problem
            $this->sorts[$field->getName()] = $field;
//        }

        return $this;
    }

    /**
     * @param string $name
     * @return QueryInterface
     */
    public function removeSort(string $name): QueryInterface
    {
        if (isset($this->sorts[$name])) {
            unset($this->sorts[$name]);
        }

        return $this;
    }

    /**
     * @param array $sorts
     * @return QueryInterface
     */
    public function addSorts(array $sorts): QueryInterface
    {
        foreach ($sorts as $sort) {
            $this->addSort($sort);
        }

        return $this;
    }

    /**
     * @param array $fields
     * @return QueryInterface
     */
    public function setSorts(array $fields): QueryInterface
    {
        $this->clearSorts();
        foreach ($fields as $field) {
            $this->addSort($field);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getSorts(): array
    {
        return is_array($this->sorts) ? $this->sorts : [];
    }

    /**
     * @return QueryInterface
     */
    public function clearSorts(): QueryInterface
    {
        $this->sorts = [];

        return $this;
    }

    /**
     * @param Field $field
     * @return QueryInterface
     */
    public function addFieldToSelect(Field $field): QueryInterface
    {
        $this->fields[$field->getName()] = $field;

        return $this;
    }

    /**
     * @param array $fields
     * @return QueryInterface
     */
    public function addFieldsToSelect(array $fields): QueryInterface
    {
        foreach ($fields as $field) {
            $this->addFieldToSelect($field);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getFieldsToSelect(): array
    {
        return $this->fields ?: [];
    }

    /**
     * @param string $name
     * @return Field|null
     */
    public function getFieldToSelect(string $name): ?Field
    {
        return $this->fields[$name] ?? null;
    }

    /**
     * @param string $name
     * @return QueryInterface
     */
    public function removeFieldToSelect(string $name): QueryInterface
    {
        if (isset($this->fields[$name])) {
            unset($this->fields[$name]);
        }

        return $this;
    }

    /**
     * @return QueryInterface
     */
    public function clearFieldsToSelect(): QueryInterface
    {
        $this->fields = [];

        return $this;
    }

    /**
     * @param array $options
     * @return QueryInterface
     */
    public function setAdditionalOptions(array $options): QueryInterface
    {
        $this->additionalOptions = $options;

        return $this;
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    /**
     * @param int $pageSize
     * @return QueryInterface
     */
    public function setPageSize(int $pageSize): QueryInterface
    {
        $this->pageSize = $pageSize;

        return $this;
    }

    /**
     * @return int
     */
    public function getPageStart(): int
    {
        return $this->pageStart ?: 0;
    }

    /**
     * @param int $pageStart
     * @return QueryInterface
     */
    public function setPageStart(int $pageStart): QueryInterface
    {
        $this->pageStart = $pageStart;

        return $this;
    }

    /**
     * @param Field $field
     * @param string|null $fieldname
     * @return QueryInterface
     */
    public function addFacet(Field $field, ?string $fieldname = null): QueryInterface
    {
        $this->facets[$fieldname ?? $field->getName()] = $field;

        return $this;
    }

    /**
     * @param array $facets
     * @return QueryInterface
     */
    public function addFacets(array $facets): QueryInterface
    {
        $this->facets = array_merge($this->facets, $facets);

        return $this;
    }

    /**
     * @return array
     */
    public function getFacets(): array
    {
        return is_array($this->facets) ? $this->facets : [];
    }

    /**
     * @param Field $statsField
     * @param string|null $statName
     * @return QueryInterface
     */
    public function addStat(Field $statsField, ?string $statName = null): QueryInterface
    {
        $this->stats[$statName ?? $statsField->getName()] = $statsField;

        return $this;
    }

    /**
     * @param array $stats
     * @return QueryInterface
     */
    public function addStats(array $stats): QueryInterface
    {
        $this->stats = array_merge($this->stats, $stats);

        return $this;
    }

    /**
     * @return array
     */
    public function getStats(): array
    {
        return is_array($this->stats) ? $this->stats : [];
    }

    /**
     * @inheritDoc
     */
    abstract public function buildQuery();

    /**
     * @inheritDoc
     */
    abstract public function getResponse(bool $rawFieldName = false);
}
