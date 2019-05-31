<?php
require_once 'init.php';
$msg = '';
if(count($_POST)>0){
    $validate = new Validation();
    $validation = $validate->check($_POST, array(
        'pass' => array(
            'name' => 'Le mot de passe',
            'required' => true,
            'min' => 6
        ),
        'pass2' => array(
            'name' => 'Le mot de passe',
            'required' => true,
            'matches' => 'pass'
        ),
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
            'unique' => 'users'
        )
    ));
    if($validation->passed()){
        $user = new User();
        $user->create(array(
            'nom' => htmlentities(trim($_POST['nom'])),
            'prenom' => htmlentities(trim($_POST['prenom'])),
            'pass' => password_hash(trim($_POST['pass']),PASSWORD_BCRYPT),
            'email' => trim($_POST['email']),
            'date_reg' => date('Y-m-d H:i:s'),
            'permission' => 1
        ));
        header('Location: login.php');
    } else {
        $msg = "<ul><li>" . implode("</li><li>", $validation->errors()) . "</li></ul>";
    }
}
?>

<!DOCTYPE html>
<html>
	<head>
    	<title>Formulaire d'inscription</title>
    	<meta charset='utf-8'>
    	<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>	
		<main>
    		<h1>Formulaire d'inscription</h1>
    		<form action="" method="post">
    		
    			<label for="nom">Nom</label>
    			<input type="text" name="nom" id="nom" value="" autocomplete="off"><br>
    		
    			<label for="prenom">Prenom</label>
    			<input type="text" name="prenom" id="prenom" value="" autocomplete="off"><br>
    		
    			<label for="password">Mot de passe</label>
    			<input type="password" name="pass" id="password" autocomplete="off"><br>
    		
    			<label for="password2">Repeter le mot de passe</label>
    			<input type="password" name="pass2" id="password2" autocomplete="off"><br>
    		
    			<label for="email">Email</label>
    			<input type="email" name="email" id="email" value="" autocomplete="off"><br>
    		
    
    			<input type="submit" id="button" value="Enregistrer"><br>
    			<a href="login.php">Vous avez deja un compte?</a>
    		</form>
    		<div id="errors">
    			<?=$msg; ?>
    		</div>
		<main>
		
	</body>
</html>