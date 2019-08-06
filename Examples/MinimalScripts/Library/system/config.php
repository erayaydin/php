<?php

class Config
{
    protected static $configs;

    public static function import() {
        self::$configs = include __DIR__."/../config.php";
    }

    public static function get($key) {
        return self::$configs[$key];
    }
}