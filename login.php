<?php
require_once 'init.php';
$msg = '';
if(count($_POST)>0){
    $validate = new Validation();
    $validation = $validate->check($_POST, array(
        'email' => array(
            'name' => 'L\'adresse email',
            'required' => true),
        'pass' => array(
            'name' => 'Le mot de passe',
            'required' => true)
    ));
    if($validation->passed()) {
        $user = new User();
        $email = htmlentities(trim($_POST['email']));
        $password = htmlentities(trim($_POST['pass']));
        $login = $user->login($email, $password);
        $admin = $user->permission($email, $password);
        if($login) {
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $user->data()->prenom;
            $_SESSION['auth_time'] = time();
            if($admin){
                $_SESSION['permission'] = true;
                header('Location: admin.php');
            } else {
                header('Location: index.php');
            }
        } else {
            $msg = "<ul><li>La connexion a echoue.</li></ul>";
        }
        
    } else {
        $msg = "<ul><li>" . implode("</li><li>", $validation->errors()) . "</li></ul>";
      }
}

?>
<!DOCTYPE html>
<html>
    <head>
    	<title>Login</title>
    	<meta charset='utf-8'>
    	<link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    	<main>
    		<h1>Login</h1>
        	<form action="" method="post">

                	<label for="email">Email</label>
                	<input type="email" name="email" id="email" value="" autocomplete="off"><br><br>
            	
                	<label for="password">Mot de passe</label>
                	<input type="password" name="pass" id="password" value="" autocomplete="off"><br><br>
          
            	<input type="submit" id="button" value="Login"><br><br>
            	<a href="registration.php">Creer un compte</a>
        	</form>
        	<div id="errors">
        		<?=$msg; ?>
        	</div>
		</main>
    </body>
</html>
