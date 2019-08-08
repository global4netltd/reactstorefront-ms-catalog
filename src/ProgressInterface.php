<?php

namespace G4NReact;

interface ProgressInterface
{
    /**
     * Called when process is started
     * @param int $total count of elements to process
     */
    public function start(int $total);

    /**
     * Called after finish each element process
     */
    public function advance();

    /**
     * Called when process is finished
     */
    public function finish();

}
