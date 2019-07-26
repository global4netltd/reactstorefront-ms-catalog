<?php

namespace G4NReact\MsCatalog\Document;

/**
 * Class FieldValue
 * @package G4NReact\MsCatalog\Document
 */
class FieldValue
{
    /** @var string infinity character */
    const IFINITY_CHARACTER = '*';
    
    /**
     * @var
     */
    protected $value;

    /**
     * @var
     */
    protected $fromValue;
    /**
     * @var
     */
    protected $toValue;

    /**
     * FieldValue constructor.
     *
     * @param null $value
     * @param null $fromValue
     * @param null $toValue
     */
    public function __construct(
        $value = null,
        $fromValue = null,
        $toValue = null
    ) {
        $this->setValue($value);
        $this->setFromValue($fromValue);
        $this->setToValue($toValue);
    }

    /**
     * @param $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $fromValue
     */
    public function setFromValue($fromValue)
    {
        $this->fromValue = $fromValue;
    }

    /**
     * @return mixed
     */
    public function getFromValue()
    {
        return $this->fromValue;
    }

    /**
     * @param $toValue
     */
    public function setToValue($toValue)
    {
        $this->toValue = $toValue;
    }

    /**
     * @return mixed
     */
    public function getToValue()
    {
        return $this->toValue;
    }
}
