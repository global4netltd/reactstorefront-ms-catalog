<?php

namespace G4NReact\MsCatalog;

use Iterator;

/**
 * Interface PullerInterface
 * @package G4NReact\MsCatalog
 */
interface PullerInterface
{
    /**
     * @return Iterator
     */
    public function pull(): Iterator;
}
