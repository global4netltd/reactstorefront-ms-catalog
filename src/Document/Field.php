<?php

namespace G4NReact\MsCatalog\Document;

use G4NReact\MsCatalog\AbstractObject;

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
        self::FIELD_TYPE_BOOL
    ];

    /**
     * @var string
     */
    protected $name;

    /**
     * @var mixed
     */
    protected $value;

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
        return $this->value;
    }

    /**
     * @param mixed $value
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
