<?php
require_once 'init.php';

if(time()-$_SESSION['auth_time'] > 10000){
    header('Location: php/logout.php');
} else {
    if(!empty($_POST['message'])){
        $message = new Communication();
        $message->create(array(
            'sent_from' => htmlentities(trim($_POST['id_sender'])),
            'sent_to' => htmlentities(trim($_POST['id_receiver'])),
            'message_text' => htmlentities(trim($_POST['message'])),
            'date_sent' => date('Y-m-d H:i:s')));
        echo $_POST['message'];
    }
}