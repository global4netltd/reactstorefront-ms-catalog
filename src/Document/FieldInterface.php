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
     * @return Field
     */
    public function setName(string $name): Field;

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * Returns Field value without casting to Field type
     * @return mixed
     */
    public function getRawValue();

    /**
     * @param mixed $value
     * @return Field
     */
    public function setValue($value): Field;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @param string $type
     * @return Field
     */
    public function setType(string $type): Field;

    /**
     * @return bool
     */
    public function getIndexable(): bool;

    /**
     * @param bool $indexable
     * @return Field
     */
    public function setIndexable(bool $indexable): Field;

    /**
     * @return bool
     */
    public function getMultiValued(): bool;

    /**
     * @param bool $multiValued
     * @return Field
     */
    public function setMultiValued(bool $multiValued): Field;
}
