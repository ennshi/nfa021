<?php
	require_once 'php/init.php';
?>

<!DOCTYPE html>
<html lang="fr-FR">
	<head>
		<meta charset="ISO-8859-1" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="css/style.css" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<title>Les Pyrénées Vertes - agence de voyage</title>
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.0.min.js"></script>
	</head>
	<body>
		<!-- Showcase/Navigation -->
		<div id="showcase">
			<header>
				<nav class='cf'>
					<ul>
					  <li class='pc'>
						<a href=''>CONTACT</a>
					  </li>
					  <li class='pc'>
						<a href=''>NOS OFFRES</a>
					  </li>
					  <li class='pc'>
						<a href=''>QUI SOMMES-NOUS?</a>
					  </li>

					  <li class='mobile'>
						<a href=''><i class="far fa-comment-dots"></i></a>
					  </li>
					  <li class='mobile'>
						<a href=''><i class="far fa-compass"></i></a>
					  </li>
					  <li class='mobile'>
						<a href=''><i class="fas fa-stream"></i></a>
					  </li>
					</ul>
				</nav>
			</header>
			<div class="section-main container">
				<h1>Les Pyrénées Vertes</h1>
				<h2>Découvrez les Pyrénées en pensant à l'environment</h2>
				<p id="description">"Les Pyrénées Vertes" est une agence de voyage située à Pau, France. 
				L'activité principale est l'organisation des randonnées de différents niveaux de difficulté et la durée dans les Pyrénées. 
				En plus de fournir un niveau de service élevé, notre valeur est la préoccupation l'écologie et le respect des populations locales.
				</p>
			</div>
		</div>
		<div id="logo-container">
			<img id="logo" src="img/logo.png" alt="logo" />
		</div>
		<!-- Our guides -->
		<section id="guides" class="container">
			<div id="section-header">
				<h2>NOTRE EQUIPE</h2>
				<?php ?>
			</div>
		</section>
		<!-- Footer -->
		<div id="foot">
			<h2>Contactez-nous</h2>
			<div id="contacts">
				<ul>
					<li>+3300000000</li>
					<li>lespyreneesvertes@gmail.com</li>
					<li>65 av. des Fleurs, Pau, 64000, France</li>
				</ul>
			</div>
		</div>
		<!-- <script>
			$(function(){
			  $("#foot").load("footer.html");
			});
		</script> -->
		<script src="js/main.js"></script>
	</body>
</html>