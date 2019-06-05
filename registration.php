<?php
require_once 'php/init.php';
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
<html lang="fr-FR">
	<head>
		<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="css/style.css" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<title>Les Pyrenees Vertes - agence de voyage</title>
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.0.min.js"></script>
	</head>
	<body>
		<div id="chat-intro">
			<header>
				<nav class='cf'>
					<ul>
					  <li class='pc'>
						<a href='chat_intro.html'>CONTACT</a>
					  </li>
					  <li class='pc'>
						<a href='index.php#offres-section'>NOS OFFRES</a>
					  </li>
					  <li class='pc'>
						<a href='index.php'>QUI SOMMES-NOUS?</a>
					  </li>

					  <li class='mobile'>
						<a href='chat_intro.html'><i class="far fa-comment-dots"></i></a>
					  </li>
					  <li class='mobile'>
						<a href='index.php#offres-section'><i class="far fa-compass"></i></a>
					  </li>
					  <li class='mobile'>
						<a href='index.php'><i class="fas fa-stream"></i></a>
					  </li>
					</ul>
				</nav>
			</header>
			<section id="main">
				<div id="section-header">
            		<h1>S'inscrire</h1>
            	</div>	
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
        		
        
        			<input type="submit" class="btn" value="Enregistrer">
        			<a class="link-reg" href="login.php">Vous avez deja un compte?</a><br>
    			</form>
        		<div id="errors">
        			<?=$msg; ?>
        		</div>
			</section>
		</div>
	</body>
</html>