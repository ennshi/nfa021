<?php
class Config{
    static $confArray = array(
        'host' => '127.0.0.1',
        'dbname' => 'pyrenees',
        'user' => 'root',
        'pass' => '',
        'charset' => 'utf8'
    );
    
    public static function read($name)
    {
        return self::$confArray[$name];
    }
}