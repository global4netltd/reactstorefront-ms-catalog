<?php

namespace G4NReact\MsCatalog\Client;

/**
 * Interface ClientInterface
 * @package G4NReact\MsCatalog\Client
 */
interface ClientInterface
{
    /**
     * @param int $id
     *
     * @return mixed
     */
    public function delete(int $id);

    /**
     * @param array $fields
     *
     * @return mixed
     */
    public function add(array $fields);

    /**
     * @param array $options
     *
     * @return mixed
     */
    public function get(array $options);

    /**
     * @param $query
     *
     * @return mixed
     */
    public function query($query);
}
