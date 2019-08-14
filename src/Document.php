<?php

namespace G4NReact\MsCatalog;

use G4NReact\MsCatalog\Document\AbstractField;
use G4NReact\MsCatalog\Document\Field;

/**
 * Class Document
 * @package G4NReact\MsCatalog
 */
class Document extends AbstractObject
{
    /**
     * @var string
     */
    private $uniqueId;

    /**
     * @var int
     */
    private $objectId;

    /**
     * @var string
     */
    private $objectType;

    /**
     * @return string
     */
    public function getUniqueId(): string
    {
        return $this->uniqueId;
    }

    /**
     * @param string $uniqueId
     *
     * @return Document
     */
    public function setUniqueId(string $uniqueId): Document
    {
        $this->uniqueId = $uniqueId;

        return $this;
    }

    /**
     * @return int
     */
    public function getObjectId(): int
    {
        return (int)$this->objectId;
    }

    /**
     * @param int $objectId
     *
     * @return Document
     */
    public function setObjectId(int $objectId): Document
    {
        $this->objectId = $objectId;

        return $this;
    }

    /**
     * @return string
     */
    public function getObjectType(): string
    {
        return (string)$this->objectType;
    }

    /**
     * @param string $objectType
     *
     * @return Document
     */
    public function setObjectType(string $objectType): Document
    {
        $this->objectType = $objectType;

        return $this;
    }

    /**
     * @return Field[]
     */
    public function getFields(): array
    {
        $fields = [];

        foreach ($this->getData() as $data) {
            if ($data instanceof Field) {
                $fields[] = $data;
            }
        }

        return $fields;
    }

    /**
     * @param string $name
     *
     * @return Field|null
     */
    public function getField(string $name)
    {
        return $this->getData($name);
    }

    /**
     * @param string $name
     *
     * @return mixed|null
     */
    public function getFieldValue(string $name)
    {
        return $this->getField($name) ? $this->getField($name)->getValue() : null;
    }

    /**
     * @param string $name
     * @param mixed|null $value
     * @param string $type
     * @param bool $indexable
     * @param bool $multiValued
     * @param array $args
     *
     * @return $this
     */
    public function createField($name, $value = null, $type = '', $indexable = false, $multiValued = false, $args = []): Document
    {
        if (!is_string($type)) {
            $type = '';
        }

        if (isset($this->_data[$name])) {
            /** @var Field $field */
            $field = $this->getField($name);
            $field->setValue($value);
            $field->setType($type);
            $field->setIndexable($indexable);
            $field->setMultiValued($multiValued);
            if (is_array($args)) {
                foreach ($args as $key => $value) {
                    $field->setData($key, $value);
                }
            }
        } else {
            $field = new Field($name, $value, $type, $indexable, $multiValued, $args);
            $this->setField($field);
        }

        return $this;
    }

    /**
     * @param Field $field
     */
    public function setField($field)
    {
        $this->_data[$field->getName()] = $field;
    }

    /**
     * @param $name
     * @param $value
     *
     * @return $this
     */
    public function setFieldValue($name, $value)
    {
        if ($this->getField($name)) {
            $this->getData($name)->setValue($value);
        }

        return $this;
    }

    /**
     * @param string $name
     */
    public function unsetField(string $name)
    {
        $this->unsetData($name);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = [];
        foreach ($this->getFields() as $field) {
            $array[$field->getName()] = $field->getValue();
        }

        return $array;
    }
}
