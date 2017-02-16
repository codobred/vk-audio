<?php

class Cache
{
    protected static $path = false;

    public static function get($key, $callback, $time)
    {
        self::$path = (self::$path) ?: __DIR__ . '/../cache';

        $file = self::$path . '/' . sha1($key);
        if (file_exists($file)) {
            if (filemtime($file) + $time > microtime()) {
                return unserialize(file_get_contents($file));
            }
            @unlink($file);
        }

        $value = $callback();
        if ($value) file_put_contents($file, serialize($value));
        return $value;
    }
}