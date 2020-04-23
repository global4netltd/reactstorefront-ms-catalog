<?php

namespace G4NReact\MsCatalog\Spellcheck;

interface  SpellcheckResponseInterface
{
    /**
     * @return SpellcheckSuggestionInterface[]
     */
    public function getSpellCorrectSuggestions(): array;
}
