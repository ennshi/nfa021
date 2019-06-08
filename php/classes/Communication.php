<?php
class Communication {
    private $_conn = null,
    $_data;
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
        $sql = "INSERT INTO `messages` (`" . implode('`,`', $keys) . "`) VALUES ({$values})";
        $stmt = $this->_conn->conn->prepare($sql);
        $stmt->execute(array_values($fields));
    }
    public function select_chat($id){
        $stmt = $this->_conn->conn->prepare("SELECT * FROM `messages` WHERE `sent_from` = ? OR `sent_to` = ? ORDER BY `date_sent`");
        $stmt->execute(array($id, $id));
        $check = $stmt->fetchAll(PDO::FETCH_OBJ);
        $this->_data = $check;
        return true;
    }
    public function data() {
        return $this->_data;
    }
}