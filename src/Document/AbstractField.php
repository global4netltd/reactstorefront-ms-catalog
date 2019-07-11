<?php

namespace G4NReact\MsCatalog\Document;

use G4NReact\MsCatalog\AbstractObject;

/**
 * Class Field
 * @package G4NReact\MsCatalog\Document
 */
class AbstractField extends AbstractObject
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
        bool $indexable = false,
        bool $multiValued = false,
        array $args = []
    )
    {
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
     * @return mixed
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
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
    public function setType(string $type)
    {
        $this->type = $type;

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
        return (string)$this->getValue();
    }

    /**
     * This function should return real field name
     * which is used for this field in selected engine
     * @return string
     */
    abstract function getFieldName();

}
