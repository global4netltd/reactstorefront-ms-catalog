<?php

namespace G4NReact\MsCatalog\Spellcheck;

interface  SpellcheckSuggestionAlternativeInterface
{
    /**
     * @return string
     */
    public function getText(): string;

    /**
     * @return int
     */
    public function getFrequency(): int;
}
