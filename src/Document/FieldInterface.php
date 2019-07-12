<?php

namespace G4NReact\MsCatalog\Document;

/**
 * Interface FieldInterface
 * @package G4NReact\MsCatalog\Document
 */
interface FieldInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return AbstractField
     */
    public function setName(string $name): AbstractField;

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @param mixed $value
     * @return AbstractField
     */
    public function setValue($value): AbstractField;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @param string $type
     * @return AbstractField
     */
    public function setType(string $type): AbstractField;

    /**
     * @return bool
     */
    public function getIndexable(): bool;

    /**
     * @param bool $indexable
     * @return AbstractField
     */
    public function setIndexable(bool $indexable): AbstractField;

    /**
     * @return bool
     */
    public function getMultiValued(): bool;

    /**
     * @param bool $multiValued
     * @return AbstractField
     */
    public function setMultiValued(bool $multiValued): AbstractField;
}
