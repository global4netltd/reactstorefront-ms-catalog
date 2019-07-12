<?php

namespace G4NReact\MsCatalog\Document;

use G4NReact\MsCatalog\AbstractObject;

/**
 * Class AbstractField
 * @package G4NReact\MsCatalog\Document
 */
class AbstractField extends AbstractObject implements FieldInterface
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
     * AbstractField constructor
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
        bool $indexable = false,
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
     * @return AbstractField
     */
    public function setName(string $name): AbstractField
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
     * @return AbstractField
     */
    public function setValue($value): AbstractField
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
     * @return AbstractField
     */
    public function setType(string $type): AbstractField
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
     * @return AbstractField
     */
    public function setIndexable(bool $indexable): AbstractField
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
     * @return AbstractField
     */
    public function setMultiValued(bool $multiValued): AbstractField
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

    /**
     * This function should return real field name
     * which is used for this field in selected engine
     * @return string
     */
//    abstract public function getFieldName();

}
