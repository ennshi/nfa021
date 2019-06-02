<?php
class Content {
    private $_conn = null,
            $_data;
    public function __construct() {
        $this->_conn = DB::getInstance();
    }
    public function collect($table){
        $stmt = $this->_conn->conn->prepare("SELECT * FROM `{$table}`");
        $stmt->execute();
        $check = $stmt->fetchAll(PDO::FETCH_OBJ);
        $this->_data = $check;
        return $this->_data;
    }
    public function select($table, $field, $value){
        $stmt = $this->_conn->conn->prepare("SELECT * FROM `{$table}` WHERE `{$field}`=?");
        $stmt->execute(array($value));
        $check = $stmt->fetchAll(PDO::FETCH_OBJ);
        $this->_data = $check;
        return $this->_data;
    }
    public function show(){
        return $this->_data;
    }
}