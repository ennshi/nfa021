<?php
	require_once 'php/init.php';
	ini_set('default_charset', 'utf-8');
	$content = new Content();
	$content->collect('guides');
	$guides = $content->show();
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
				<?php echo "<h1>Les Pyr&eacute;n&eacute;es Vertes</h1>";?>
				<h2>D&eacute;couvrez les Pyr&eacute;n&eacute;es en pensant &agrave; l'environment</h2>
				<p id="description">"Les Pyr&eacute;n&eacute;es Vertes" est une agence de voyage situ&eacute;e &agrave; Pau, France. 
				L'activit&eacute; principale est l'organisation des randonn&eacute;es de diff&eacute;rents niveaux de difficult&eacute; et la dur&eacute;e dans les Pyr&eacute;n&eacute;es. 
				En plus de fournir un niveau de service &eacute;lev&eacute;, notre valeur est la pr&eacute;occupation l'&eacute;cologie et le respect des populations locales.
				</p>
			</div>
		</div>
		<div id="logo-container">
			<img id="logo" src="img/logo.png" alt="logo" />
		</div>

		<section id="guides" class="container">
			<div id="section-header">
				<h2>NOTRE EQUIPE</h2>
			</div>	
				<?php 
				foreach($guides as $guide){
				    echo "<div class='guides'>
                            <img width='150' src=\"img/guides/{$guide->photo}.jpg\" alt='photo of guide'>
				            <p>{$guide->fname} {$guide->lname}<br>
                            Experience: {$guide->experience} ans<br>
                            {$guide->description}</p>
				        </div>";
				}
				?>
			
		</section>

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