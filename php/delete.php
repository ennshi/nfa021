<?php
require_once 'init.php';
if(time()-$_SESSION['auth_time'] > 10000){
    header('Location: logout.php');
} else {
    $user = new User;
    if($user->delete($_POST['user'])){
        echo "User #{$_POST['user']} deleted";
    } else {
        echo "error";
    }
}