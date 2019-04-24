<?php

namespace G4NReact\MsCatalog;

/**
 * Class AbstractObject
 * @package G4NReact\MsCatalog
 */
abstract class AbstractObject
{
    /**
     * Setter/Getter underscore transformation cache
     *
     * @var array
     */
    protected static $_uncamelizedCache = array();

    /**
     * @var array
     */
    protected $_data = [];

    /**
     * @param $method
     * @param $args
     * @return bool|AbstractObject|mixed|null
     */
    public function __call($method, $args)
    {
        switch (substr($method, 0, 3)) {
            case 'get' :
                $name = $this->_uncamelize(substr($method,3));
                $data = $this->getData($name, isset($args[0]) ? $args[0] : null);
                return $data;

            case 'set' :
                $name = $this->_uncamelize(substr($method,3));
                $result = $this->setData($name, isset($args[0]) ? $args[0] : null);
                return $result;

            case 'uns' :
                $name = $this->_uncamelize(substr($method,3));
                $result = $this->unsetData($name);
                return $result;

            case 'has' :
                $name = $this->_uncamelize(substr($method,3));
                return isset($this->$_data[$name]);
        }
        throw new Exception("Invalid method ".get_class($this)."::".$method."(".print_r($args,1).")");
    }

    /**
     * @param string $name
     * @return mixed|string
     */
    protected function _uncamelize($name)
    {
        if (isset(self::$_uncamelizedCache[$name])) {
            return self::$_uncamelizedCache[$name];
        }
        $result = strtolower(preg_replace('/(.)([A-Z])/', "$1_$2", $name));
        self::$_uncamelizedCache[$name] = $result;
        return $result;
    }

    /**
     * @param string $name
     * @param mixed|null $value
     * @return $this
     */
    public function setData($name, $value = null)
    {
        $this->_data[$name] = $value;

        return $this;
    }

    /**
     * @param string|null $name
     * @return mixed|null
     */
    public function getData($name = null)
    {
        if (is_null($name)) {
            return $this->_data;
        }

        return $this->_data[$name] ?? null;
    }

    /**
     * @param string|null $name
     * @return $this
     */
    public function unsetData($name = null)
    {
        if (is_null($name)) {
            $this->_data = [];
        } elseif (isset($this->_data[$name])) {
            unset($this->_data[$name]);
        }

        return $this;
    }
}
