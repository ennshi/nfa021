<?php
require_once 'init.php';
if(time()-$_SESSION['auth_time'] > 10000){
    header('Location: logout.php');
} else {
    $msg = 'here';
    if(count($_POST)>0){
        $validate = new Validation();
        $validation = $validate->check($_POST, array(
            'prenom' => array(
                'name' => 'Le prenom',
                'required' => true,
                'letters' =>true,
                'min' => 2,
                'max' => 50
            ),
            'nom' => array(
                'name' => 'Le nom',
                'required' => true,
                'letters' =>true,
                'min' => 2,
                'max' => 50
            ),
            'email' => array(
                'name' => 'L\'adresse email',
                'email_filter' => true,
                'required' => true,
                'unique_or_same' => 'last_email'
            )
        ));
        if($validation->passed()){
            $user = new User();
            $user->update($_POST['id'], array(
                'nom' => htmlentities(trim($_POST['nom'])),
                'prenom' => htmlentities(trim($_POST['prenom'])),
                'email' => trim($_POST['email'])
            ));
            $msg = "Success";
        } else {
            $msg = implode($validation->errors());
        }
        echo $msg;
    }
    
}