<?php

class User {
    private $_conn = null,
            $_data,
            $_ids;
    public function __construct() {
                $this->_conn = DB::getInstance();
    }
    
    public function create($fields = array()){
        $keys = array_keys($fields);
        $values = '';
        $x = 1;
        foreach($fields as $field) {
            $values .= '?';
            if($x < count($fields)) {
                $values .= ', ';
            }
            $x++;
        }
        $sql = "INSERT INTO `users` (`" . implode('`,`', $keys) . "`) VALUES ({$values})";
        $stmt = $this->_conn->conn->prepare($sql);
        $stmt->execute(array_values($fields));
    }
    public function find($user){
        if($user) {
            $field = (is_numeric($user)) ? 'id' : 'email';
            $stmt = $this->_conn->conn->prepare("SELECT * FROM `users` WHERE `{$field}` = ?");
            $stmt->execute(array($user));
            $check = $stmt->fetchAll(PDO::FETCH_OBJ);
            if($check){
                $this->_data = $check[0];
                return true;
            }
        }
    }
    public function login($email, $password){
        $login = false;
        $user = $this->find($email);
        if($user){
            if(password_verify($password, $this->data()->pass)){
                $login = true;
            }
        }
        return $login;
    }
    public function permission($email, $password){
        $permission = false;
        $user = $this->login($email, $password);
        if($user){
            if($this->data()->permission === '2'){
                $permission = true;
            }
        }
        return $permission;
    }
    public function delete($id){
        $user = $this->find($id);
        if($user){
            $stmt = $this->_conn->conn->prepare("DELETE FROM `users` WHERE `id` = ?");
            $stmt->execute(array($id));
            return true;
        }
    }
    public function update($id,$fields = array()){
        $fields_sql = '';
        $x = 1;
        foreach($fields as $field=>$value){
            $part = "`{$field}` = ?";
            $fields_sql .= $part;
            if($x < count($fields)) {
                $fields_sql .= ', ';
            }
            $x++;
        }
        $sql = "UPDATE `users` SET {$fields_sql} WHERE `id` = {$id}";
        $stmt = $this->_conn->conn->prepare($sql);
        $stmt->execute(array_values($fields));
    }
    public function userIds(){
        $stmt = $this->_conn->conn->prepare("SELECT `id` FROM `users`");
        $stmt->execute();
        $check = $stmt->fetchAll(PDO::FETCH_OBJ);
        $this->_ids = $check;
        return $this->_ids;
    }
    public function data() {
        return $this->_data;
    }
   
}