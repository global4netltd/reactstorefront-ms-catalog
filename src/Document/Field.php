<?php

namespace G4NReact\MsCatalog\Document;

use G4NReact\MsCatalog\AbstractObject;
use G4NReact\MsCatalog\FieldHelper;

/**
 * Class Field
 * @package G4NReact\MsCatalog\Document
 */
class Field extends AbstractObject implements FieldInterface
{
    const FIELD_TYPE_STATIC = 'static';
    const FIELD_TYPE_STRING = 'string';
    const FIELD_TYPE_INT = 'int';
    const FIELD_TYPE_TEXT = 'text';
    const FIELD_TYPE_VARCHAR = 'varchar';
    const FIELD_TYPE_DATETIME = 'datetime';
    const FIELD_TYPE_DECIMAL = 'decimal';
    const FIELD_TYPE_FLOAT = 'float';
    const FIELD_TYPE_DOUBLE = 'double';
    const FIELD_TYPE_BOOL = 'bool';
    const FIELD_TYPE_MEDIUMTEXT = 'mediumtext';
    const FIELD_TYPE_SMALLINT = 'smallint';
    const FIELD_TYPE_TIMESTAMP = 'timestamp';
    const FIELD_TYPE_DATE = 'date';
    const FIELD_TYPE_TEXT_SEARCH = 'text_search';
    const FIELD_TYPE_TEXT_SEARCH_PRIMARY = 'primary_search';
    const FIELD_TYPE_TEXT_WORDS = 'text_words';

    /**
     * @var array
     */
    public static $availableTypes = [
        self::FIELD_TYPE_STATIC,
        self::FIELD_TYPE_STRING,
        self::FIELD_TYPE_INT,
        self::FIELD_TYPE_TEXT,
        self::FIELD_TYPE_VARCHAR,
        self::FIELD_TYPE_DATETIME,
        self::FIELD_TYPE_DECIMAL,
        self::FIELD_TYPE_FLOAT,
        self::FIELD_TYPE_DOUBLE,
        self::FIELD_TYPE_BOOL,
        self::FIELD_TYPE_MEDIUMTEXT,
        self::FIELD_TYPE_SMALLINT,
        self::FIELD_TYPE_TIMESTAMP,
        self::FIELD_TYPE_DATE,
        self::FIELD_TYPE_TEXT_SEARCH,
        self::FIELD_TYPE_TEXT_SEARCH_PRIMARY,
        self::FIELD_TYPE_TEXT_WORDS,
    ];

    /**
     * @var array
     */
    public static $numericFieldTypes = [
        self::FIELD_TYPE_INT,
        self::FIELD_TYPE_DECIMAL,
        self::FIELD_TYPE_FLOAT,
        self::FIELD_TYPE_DOUBLE,
        self::FIELD_TYPE_SMALLINT,
    ];
    
    /**
     * @var string
     */
    protected $name;

    /**
     * @var mixed
     */
    protected $value = null;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var bool
     */
    protected $indexable;

    /**
     * @var bool
     */
    protected $multiValued;

    /**
     * Field constructor
     *
     * @param string $name
     * @param mixed $value
     * @param string $type
     * @param bool $indexable
     * @param bool $multiValued
     * @param array $args
     */
    public function __construct(
        string $name,
        $value = null,
        string $type = '',
        bool $indexable = true,
        bool $multiValued = false,
        array $args = []
    ) {
        $this->setName($name);
        $this->setValue($value);
        $this->setType($type);
        $this->setIndexable($indexable);
        $this->setMultiValued($multiValued);

        if (is_array($args)) {
            foreach ($args as $key => $value) {
                $this->setData($key, $value);
            }
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Field
     */
    public function setName(string $name): Field
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        if (!is_array($this->value)) {
            switch ($this->getType()) {
                case $this->value instanceof FieldValue:
                    return $this->value->getValue();
                case self::FIELD_TYPE_INT:
                    return (int)$this->value;
                case self::FIELD_TYPE_FLOAT:
                    return (float)$this->value;
                case self::FIELD_TYPE_BOOL:
                    return (bool)$this->value;
                case self::FIELD_TYPE_STRING:
                case self::FIELD_TYPE_VARCHAR:
                    return mb_strcut($this->value, 0, 32766); // @todo do it on library level
                case self::FIELD_TYPE_TEXT_SEARCH:
                case self::FIELD_TYPE_TEXT_SEARCH_PRIMARY:
                    return mb_strtolower(
                        FieldHelper::alphanum(
                            mb_strcut($this->value, 0, 32766),
                            true,
                            false
                        )
                    );
            }
        } elseif(is_array($this->value)) {

            $multi = array_filter($this->value, 'is_array');
            if(count($multi) > 0) {
                $this->value = call_user_func_array('array_merge', $this->value);
            }

            switch ($this->getType()) {
                case self::FIELD_TYPE_INT:
                    return array_map('intval', $this->value);
                case self::FIELD_TYPE_FLOAT:
                    return array_map('floatval', $this->value);
                case self::FIELD_TYPE_BOOL:
                    return array_map('boolval', $this->value);
                case self::FIELD_TYPE_STRING:
                case self::FIELD_TYPE_VARCHAR:
                    return array_map('strval', $this->value);
                default:
                    return $this->value;
            }
        } else {
            return $this->value ?: [];
        }

        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getRawValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     *
     * @return Field
     */
    public function setValue($value): Field
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return Field
     */
    public function setType(string $type): Field
    {
        if (in_array($type, self::$availableTypes)) {
            $this->type = $type;
        } else {
            $this->type = self::FIELD_TYPE_STATIC;
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function getIndexable(): bool
    {
        return $this->indexable;
    }

    /**
     * @param bool $indexable
     *
     * @return Field
     */
    public function setIndexable(bool $indexable): Field
    {
        $this->indexable = $indexable;

        return $this;
    }

    /**
     * @return bool
     */
    public function getMultiValued(): bool
    {
        return $this->multiValued;
    }

    /**
     * @param bool $multiValued
     *
     * @return Field
     */
    public function setMultiValued(bool $multiValued): Field
    {
        $this->multiValued = $multiValued;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $value = $this->getValue();
        if (is_array($value)) {
            return implode(', ', $value);
        }

        return (string)$value;
    }
}
