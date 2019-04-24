<?php

namespace G4NReact\MsCatalog\Document;

use G4NReact\MsCatalog\AbstractObject;

/**
 * Class Field
 * @package G4NReact\MsCatalog\Document
 */
class Field extends AbstractObject
{
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
     * Field constructor
     * @param string $name
     * @param mixed $value
     * @param string $type
     * @param bool $indexable
     * @param array $args
     */
    public function __construct(
        string $name,
        $value = null, 
        string $type = '',
        bool $indexable = false,
        array $args = []
    ) {
        $this->name = $name;
        $this->value = $value;
        $this->type = $type;
        $this->indexable = $indexable;

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
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->getValue();
    }
}
