<?php

namespace G4NReact\MsCatalog\Spellcheck;

interface  SpellcheckSuggestionInterface
{
    /**
     * @return string
     */
    public function getText(): string;

    /**
     * @return SpellcheckSuggestionAlternativeInterface[]
     */
    public function getAlternatives(): array;

    /**
     * @return SpellcheckSuggestionAlternativeInterface[]
     */
    public function getSortedAlternatives(): array;

    /**
     * @return int
     */
    public function getNumberOfAlternatives(): int;

    /**
     * @return int
     */
    public function getOriginalFrequency(): int;
}
