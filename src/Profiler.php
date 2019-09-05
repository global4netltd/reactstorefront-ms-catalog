<?php

namespace G4NReact\MsCatalog;

/**
 * Class Profiler
 * @package G4NReact\MsCatalog
 */
class Profiler
{
    /**
     * @var array
     */
    public static $debugInfo = [];

    /**
     * @return array
     */
    public static function getDebugInfo()
    {
        return self::$debugInfo;
    }

    /**
     * @return array
     */
    public static function getTimers()
    {
        return self::$debugInfo['timers'] ?? [];
    }

    /**
     * @param string $timerName
     * @param float $time
     */
    public static function increaseTimer(string $timerName, float $time)
    {
        if (!isset(self::$debugInfo['timers'][$timerName])) {
            self::$debugInfo['timers'][$timerName] = 0;
        }

        self::$debugInfo['timers'][$timerName] += $time;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public static function addDebugInfoEntry(string $name, $value)
    {
        self::$debugInfo[$name] = $value;
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public static function getDebugInfoEntry(string $name)
    {
        return self::$debugInfo[$name] ?? null;
    }
}
