<?php

namespace G4NReact\MsCatalog\Client;

use G4NReact\MsCatalog\PullerInterface;
use G4NReact\MsCatalog\PusherInterface;
use G4NReact\MsCatalog\QueryInterface;
use G4NReact\MsCatalog\ResponseInterface;

/**
 * Interface ClientInterface
 * @package G4NReact\MsCatalog\Client
 */
interface ClientInterface
{
    /**
     * @param string|int $id
     *
     * @return ResponseInterface
     */
    public function deleteById($id): ResponseInterface;

    /**
     * @param array $ids
     *
     * @return ResponseInterface
     */
    public function deleteByIds(array $ids): ResponseInterface;

    /**
     * @param array $fields
     *
     * @return ResponseInterface
     */
    public function deleteByFields(array $fields) : ResponseInterface;

    /**
     * @param array $fields
     *
     * @return ResponseInterface
     */
    public function add(array $fields): ResponseInterface;

    /**
     * @param array $options
     *
     * @return ResponseInterface
     */
    public function get(array $options): ResponseInterface;

    /**
     * @param $query
     *
     * @return ResponseInterface
     */
    public function query($query): ResponseInterface;

    /**
     * @return PullerInterface
     */
    public function getPuller(): PullerInterface;

    /**
     * @return PusherInterface
     */
    public function getPusher(): PusherInterface;

    /**
     * @return QueryInterface
     */
    public function getQuery(): QueryInterface;

    /**
     * @param string $name
     * @param null $value
     * @param string $type
     * @param bool $indexable
     * @param bool $multiValued
     * @param array $args
     *
     * @return mixed
     */
    public function getField(string $name, $value = null, string $type = '', bool $indexable = false, bool $multiValued = false, array $args = []);
}
