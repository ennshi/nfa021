<?php
require_once 'php/init.php';
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
            $_SESSION['id'] = $user->data()->id;
            $_SESSION['name'] = $user->data()->prenom;
            $_SESSION['auth_time'] = time();
            if($admin){
                $_SESSION['permission'] = true;
                $_SESSION['id'] = 0;
                header('Location: admin.php');
            } else {
                header('Location: account.php');
            }
        } else {
            $msg = "<ul><li>La connexion a echoue.</li></ul>";
        }
        
    } else {
        $msg = "<ul><li>" . implode("</li><li>", $validation->errors()) . "</li></ul>";
      }
}

?>
	<head>
		<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<meta name="robots" content="noindex" />
		<link rel="stylesheet" href="css/style.css" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<title>Les Pyrenees Vertes - S'inscrire</title>
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.0.min.js"></script>
	</head>
	<body>
		<div id="chat-intro">
			<?php include('php/nav.php');?>
			<section id="main">
				<div id="section-header">
            		<h1>Se connecter</h1>
				</div>
				<form action="" method="post">
                	<label for="email">Email</label>
                	<input class="login" type="email" name="email" id="email" value="" autocomplete="off"><br>
            	
                	<label for="password">Mot de passe</label>
                	<input class="login" type="password" name="pass" id="password" value="" autocomplete="off"><br>
          
                	<input type="submit" class="btn" value="Se connecter">
                	<a class="link-reg" href="registration.php">Creer un compte</a>
            	</form>
            	<div id="errors">
            		<?=$msg; ?>
            	</div>
			</section>
		</div>
		<?php include('php/footer.php');?>
	</body>
</html>
