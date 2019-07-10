<?php

namespace G4NReact\MsCatalog\Client;

/**
 * Interface ClientInterface
 * @package G4NReact\MsCatalog\Client
 */
interface ClientInterface
{
    /**
     * @param string|int $id
     *
     * @return mixed
     */
    public function deleteById($id);

    /**
     * @param array $ids
     *
     * @return mixed
     */
    public function deleteByIds(array $ids);

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
