<?php
class DB{
    public $conn; 
    private static $instance;
    
    private function __construct(){
        $dsn = 'mysql:host=' . Config::read('host') .
        ';dbname=' . Config::read('dbname') .
        ';charset=' . Config::read('charset');
        
        $user = Config::read('user');

        $password = Config::read('pass');
        
        $this->conn = new PDO($dsn, $user, $password);
    }
    
    public static function getInstance(){
        if (!isset(self::$instance))
        {
            $object = __CLASS__;
            self::$instance = new $object;
        }
        return self::$instance;
    }
    
}