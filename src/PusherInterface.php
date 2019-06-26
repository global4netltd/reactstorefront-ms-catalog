<?php

namespace G4NReact\MsCatalog;

/**
 * Interface PusherInterface
 * @package G4NReact\MsCatalog
 */
interface PusherInterface
{
    /**
     * @param PullerInterface $puller
     * @return ResponseInterface
     */
    public function push(PullerInterface $puller): ResponseInterface;
}
