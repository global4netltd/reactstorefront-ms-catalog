<?php

namespace G4NReact\MsCatalog;

/**
 * Class Query
 * @package G4NReact\MsCatalog
 */
class Query
{
    /**
     * @var
     */
    public $type;

    /**
     * @var \G4NReact\MsCatalogSolr\Config
     */
    public $config;

    /**
     * @var
     */
    public $options;

    /**
     * @var \G4NReact\MsCatalogSolr\Puller
     */
    public $puller;

    /**
     * @var \G4NReact\MsCatalogSolr\Query\ProductQuery
     */
    public $query;

    /**
     * @var array
     */
    public $sort;

    /**
     * @var array
     */
    public $searchFields = [];

    /**
     * @var array
     */
    public $filterQueries = [];

    /**
     * @var string
     */
    public $searchAdditionalInfo = '';

    /**
     * Query constructor.
     * @param $type
     * @param $config
     * @param $options
     */
    public function __construct($type, $config, $options)
    {
        $this->options = $options;
        $this->type = $type;
        $this->config = $config;
        // @ToDo: Temporarily solution - change this ASAP
        $this->puller = \G4NReact\MsCatalog\PullerFactory::create($config);
        $this->query = $this->puller->getQuery();
    }

    /**
     * @return \G4NReact\MsCatalogSolr\Response
     */
    public function getResult()
    {
        $queryStr = '*';
        $queryText = '';

        if (isset($this->options['search'])) {
            $fields = $this->getSearchFields();
            if ($this->type == 'solr') {
                $queryText = (isset($fields['boost']) ? $fields['boost'] : '');
            }
            $searchText = mb_strtolower($this->options['search']);
            $searchText = $this->convertPolishLetters($searchText);

            $queryText .= $this->getQueryStringByValue($searchText, $fields);
            $queryText .= $this->getSearchAdditionalInfo();

            $this->query->setQueryText($queryText);
        }

        if (isset($this->options['filter'])) {
            $queryStr = $this->buildFilterQueryText($this->options['filter']);
            $this->query->setFilterQueryText($queryStr);
        }

        if (isset($this->options['filter_query'])) {
            foreach ($this->options['filter_query'] as $key => $value) {
                $this->query->addFilterQuery(['key' => $key, 'query' => $key . ':' . $value]);
            }
        }

        if (isset($this->options['facet'])) {
            $this->query->setFacet(true);
            $this->query->setFacetFields($this->options['facet']);
        }

        if (isset($this->options['stat'])) {
            $this->query->setFacet(true);
            $this->query->setStatFilds($this->options['stat']);
        }
        
        if (isset($this->options['fields_to_fetch'])) {
            $this->query->setFieldsToFetch($this->options['fields_to_fetch']);
        }

        if (isset($this->options['pageSize'])) {
            $this->query->setPageSize($this->options['pageSize']);
        }

        if (isset($this->options['currentPage'])) {
            $this->query->setCurrentPage($this->options['currentPage']);
        }

        if ($sort = $this->getSort()) {
            $this->query->setSort($sort);
        }

        $result = $this->puller->pull($this->query);

        return $result;
    }

    /**
     * @param $filters
     * @return string
     */
    public function buildFilterQueryText($filters)
    {
        $queryStr = [];
        $queryFilter = [];
        foreach ($filters as $filter) {
            if (is_array($filter)) {
                $queryStr[] = '(' . $this->buildFilterQueryText($filter) . ')';
            } else {
                $codeAndFilter = explode('=', $filter);
                $code = $codeAndFilter[0];
                $value = $codeAndFilter[1];

                if (stripos($value, ',') !== false) {
                    $multi = [];
                    foreach (explode(',', $value) as $elem) {
                        $multi[] = $code . ':' . $elem;
                    }
                    $queryFilter[] = '(' . implode(' OR ', $multi) . ')';
                } elseif (stripos($value, '\-') !== false) {
                    $queryFilter[] = $code . ':' . $value;
                } elseif (stripos($value, '-') !== false) {
                    $ranges = explode('-', $value);
                    $queryFilter[] = $code . ':[' . $ranges[0] . ' TO ' . $ranges[1] . ']';
                } else {
                    $queryFilter[] = $code . ':' . $value;
                }
            }
        }

        if (!empty($queryFilter)) {
            $queryStr[] = implode(' AND ', $queryFilter);
        }

        return implode(' OR ', $queryStr);
    }

    /**
     * @param $sort
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
    }

    /**
     * @return mixed
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param $fields
     */
    public function setSearchFields($fields)
    {
        $this->searchFields = $fields;
    }

    /**
     * @param $key
     * @param $value
     */
    public function addSearchField($key, $value)
    {
        $this->searchFields[$key] = $value;
    }

    /**
     * @return mixed
     */
    public function getSearchFields()
    {
        return $this->searchFields;
    }

    /**
     * @param $additionalInfo
     */
    public function setSearchAdditionalInfo($additionalInfo)
    {
        $this->searchAdditionalInfo = $additionalInfo;
    }

    /**
     * @return mixed
     */
    public function getSearchAdditionalInfo()
    {
        return $this->searchAdditionalInfo;
    }

    /**
     * @param $value
     * @param array $fields
     * @return string
     */
    public function getQueryStringByValue($value, $fields = array())
    {
        $clearValue = (strpos($value, ' ') !== false) ? str_replace(' ', '', $value) : false;

        $regexText = false;
        if (preg_match_all('/(.* . )(.*)/', $value, $matches) && (count($matches) == 3)) {
            $regexText = str_replace(' ', '', $matches[1][0]) . ' ' . $matches[2][0];
        }

        $queryText = '';
        $isFirst = true;

        foreach ($fields as $field => $priority) {
            if ($this->type == 'solr' && $field == 'boost') {
                continue;
            }

            $queryText .= ($isFirst) ? '' : ' OR ';
            $queryText .= $field . ':"' . $value . '"' . $priority;
            if ($clearValue) {
                $queryText .= ' OR ' . $field . ':"' . $clearValue . '"' . $priority;
            }
            if ($regexText) {
                $queryText .= ' OR ' . $field . ':"' . $regexText . '"' . $priority;
            }
            $isFirst = false;
        }

        return $queryText;
    }

    /**
     * Converts polish letters to non diacritic version
     * @param $string
     * @return string
     */
    static function convertPolishLetters($string)
    {
        $table = Array(
            //WIN
            "\xb9"     => "a", "\xa5" => "A", "\xe6" => "c", "\xc6" => "C",
            "\xea"     => "e", "\xca" => "E", "\xb3" => "l", "\xa3" => "L",
            "\xf3"     => "o", "\xd3" => "O", "\x9c" => "s", "\x8c" => "S",
            "\x9f"     => "z", "\xaf" => "Z", "\xbf" => "z", "\xac" => "Z",
            "\xf1"     => "n", "\xd1" => "N",
            //UTF
            "\xc4\x85" => "a", "\xc4\x84" => "A", "\xc4\x87" => "c", "\xc4\x86" => "C",
            "\xc4\x99" => "e", "\xc4\x98" => "E", "\xc5\x82" => "l", "\xc5\x81" => "L",
            "\xc3\xb3" => "o", "\xc3\x93" => "O", "\xc5\x9b" => "s", "\xc5\x9a" => "S",
            "\xc5\xbc" => "z", "\xc5\xbb" => "Z", "\xc5\xba" => "z", "\xc5\xb9" => "Z",
            "\xc5\x84" => "n", "\xc5\x83" => "N",
            //ISO
            "\xb1"     => "a", "\xa1" => "A", "\xe6" => "c", "\xc6" => "C",
            "\xea"     => "e", "\xca" => "E", "\xb3" => "l", "\xa3" => "L",
            "\xf3"     => "o", "\xd3" => "O", "\xb6" => "s", "\xa6" => "S",
            "\xbc"     => "z", "\xac" => "Z", "\xbf" => "z", "\xaf" => "Z",
            "\xf1"     => "n", "\xd1" => "N");

        return strtr($string, $table);
    }

    /**
     * @param array $filterQuery
     * @return $this
     */
    public function setFilterQuery(array $filterQuery)
    {
        $this->filterQueries[] = $filterQuery;

        return $this;
    }
}
