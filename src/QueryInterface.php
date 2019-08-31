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
     * @param string $queryText
     * @return QueryInterface
     */
    public function setQueryText(string $queryText): QueryInterface;

    /**
     * @return string
     */
    public function getQueryText(): string;

    /**
     * @param Field $field
     * @param bool $negative
     * @param string $operator
     * @return QueryInterface
     */
    public function addFilter(Field $field, $negative = false, string $operator = 'AND'): QueryInterface;

    /**
     * @param array $filters
     * @return QueryInterface
     */
    public function addFilters(array $filters): QueryInterface;

    /**
     * @return QueryInterface
     */
    public function clearFilters(): QueryInterface;

    /**
     * @return array
     */
    public function getFilters(): array;

    /**
     * @param string $name
     * @return array
     */
    public function getFilter(string $name): array;

    /**
     * @param Field $field
     * @return QueryInterface
     */
    public function addSort(Field $field): QueryInterface;

    /**
     * @param string $name
     * @return QueryInterface
     */
    public function removeSort(string $name): QueryInterface;

    /**
     * @param Field[] $sorts
     * @return QueryInterface
     */
    public function addSorts(array $sorts): QueryInterface;

    /**
     * Replace current sort fields with new one
     * Array should be build in field => direction convention
     * @param Field[] $fields
     * @return QueryInterface
     */
    public function setSorts(array $fields): QueryInterface;

    /**
     * @return Field[]
     */
    public function getSorts();

    /**
     * Clear all current set sort in query
     * @return QueryInterface
     */
    public function clearSorts(): QueryInterface;

    /**
     * @param Field $field
     * @return QueryInterface
     */
    public function addFieldToSelect(Field $field): QueryInterface;

    /**
     * @param Field[] $fields
     * @return QueryInterface
     */
    public function addFieldsToSelect(array $fields): QueryInterface;

    /**
     * @return QueryInterface
     */
    public function clearFieldsToSelect(): QueryInterface;

    /**
     * @return array
     */
    public function getFieldsToSelect(): array;

    /**
     * @param string $name
     * @return Field|null
     */
    public function getFieldToSelect(string $name): ?Field;

    /**
     * @param string $name
     * @return QueryInterface
     */
    public function removeFieldToSelect(string $name): QueryInterface;

    /**
     * @param array $options
     * @return QueryInterface
     */
    public function setAdditionalOptions(array $options): QueryInterface;

    /**
     * @return int
     */
    public function getPageSize(): int;

    /**
     * @param int $pageSize
     * @return QueryInterface
     */
    public function setPageSize(int $pageSize): QueryInterface;

    /**
     * @return int
     */
    public function getCurrentPage(): ?int;

    /**
     * @param int $pageSize
     * @return QueryInterface
     */
    public function setCurrentPage(int $currentPage): QueryInterface;

    /**
     * @return int
     */
    public function getPageStart(): int;

    /**
     * @param int $pageStart
     * @return QueryInterface
     */
    public function setPageStart(int $pageStart): QueryInterface;

    /**
     * @param Field $field
     * @param string|null $fieldname
     * @return QueryInterface
     */
    public function addFacet(Field $field, ?string $fieldname = null): QueryInterface;

    /**
     * @param array $facets
     * @return QueryInterface
     */
    public function addFacets(array $facets): QueryInterface;

    /**
     * @return array
     */
    public function getFacets(): array;

    /**
     * @param Field $statsField
     * @param string|null $statName
     * @return QueryInterface
     */
    public function addStat(Field $statsField, ?string $statName = null): QueryInterface;

    /**
     * @param array $stats
     * @return QueryInterface
     */
    public function addStats(array $stats): QueryInterface;

    /**
     * @return array
     */
    public function getStats(): array;

    /**
     * Build query and return instance of data which is
     * matching to engine library
     * @return mixed
     */
    public function buildQuery();

    /**
     * @param bool $rawFieldName
     *
     * Run query and get response (@return ResponseInterface
     * @see ResponseInterface) from
     * selected engine library
     */
    public function getResponse(bool $rawFieldName = false);
}
