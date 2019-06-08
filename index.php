<?php
	require_once 'php/init.php';
	ini_set('default_charset', 'utf-8');
	$content = new Content();
	$content->collect('guides');
	$guides = $content->show();
	
	$content2 = new Content();
	$content2->select('offres', 'difficulty', '1');
	$promenades = $content2->show();
	$content2->select('offres', 'difficulty', '2');
	$marches = $content2->show();
	$content2->select('offres', 'difficulty', '3');
	$montagnes = $content2->show();
	
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
						<a href='chat_intro.php'>CONTACT</a>
					  </li>
					  <li class='pc'>
						<a href='#offres-section'>NOS OFFRES</a>
					  </li>
					  <li class='pc'>
						<a href='#section-main'>QUI SOMMES-NOUS?</a>
					  </li>

					  <li class='mobile'>
						<a href='chat_intro.php'><i class="far fa-comment-dots"></i></a>
					  </li>
					  <li class='mobile'>
						<a href='#offres-section'><i class="far fa-compass"></i></a>
					  </li>
					  <li class='mobile'>
						<a href='#section-main'><i class="fas fa-stream"></i></a>
					  </li>
					</ul>
				</nav>
			</header>
			<div id="section-main" class="container">
				<?php echo "<h1 id='h1-title'>Les Pyr&eacute;n&eacute;es Vertes</h1>";?>
				<h2>D&eacute;couvrez les Pyr&eacute;n&eacute;es en pensant &agrave; l'environment</h2>
				<p id="description">"Les Pyr&eacute;n&eacute;es Vertes" est une agence de voyage situ&eacute;e &agrave; Pau, France. 
				L'activit&eacute; principale est l'organisation de randonn&eacute;es de diff&eacute;rents niveaux de difficult&eacute; et dur&eacute;e dans les Pyr&eacute;n&eacute;es. 
				En plus de fournir un niveau de service &eacute;lev&eacute;, nos valeurs sont la pr&eacute;occupation &eacute;cologique et le respect des populations locales.
				</p>
			</div>
		</div>
		<div id="logo-container">
			<img id="logo" src="img/logo.png" alt="logo" />
		</div>

		<section id="guides-section" class="container">
			<div id="section-header">
				<h2>NOTRE EQUIPE</h2>
			</div>	
				<?php 
				foreach($guides as $guide){
				    echo "<div class='guides'>
                            <img width='150' src=\"img/guides/{$guide->photo}.jpg\" alt='photo of guide'>
				            <h4>{$guide->fname} {$guide->lname}</h4>
                            <p><span class=\"description\"><b>Exp&eacute;rience:</b> {$guide->experience} ans<br>
                            {$guide->description}</span></p>
				        </div>";
				}
				?>

		</section>
		<section id="offres-section" class="container">
			<div id="section-header">
				<h2>NOS OFFRES</h2>
			</div>
			<?php 
			echo "<div class='heading-cats' id='promenades-head'>
                    <h3>PROMENADES</h3>
                    <p class='heading-cat-description'>Des randonn&eacute;es de moins de 3 heures et facile</p>
                  </div>";
			?>
			<div class='cat-content' id='promenades'>
            <?php foreach($promenades as $promenade){
                    echo "<h4>$promenade->nom</h4><br>
                        <p>$promenade->description<br>
                        <b>Location:</b> {$promenade->location} <br>
                        <b>Dur&eacute;e:</b> {$promenade->duration} heures<br>
                        <b>Prix(par personne):</b> {$promenade->prix}&euro;<br></p>";
            }?>
            </div>
            <?php echo "<div class='heading-cats'id='marches-head'>
                    <h3>MARCHES</h3>
                    <p class='heading-cat-description'>Des randonn&eacute;es de moins de 6 heures et de difficult&eacute; moyenne</p>
                  </div>";
            ?>
            <div class='cat-content' id='marches'>
            <?php foreach($marches as $marche){
                    echo "<h4>$marche->nom</h4><br>
                        <p>$marche->description<br>
                        <b>Location:</b> {$marche->location} <br>
                        <b>Dur&eacute;e:</b> {$marche->duration} heures<br>
                        <b>Prix(par personne):</b> {$marche->prix}&euro;<br></p>";
            }?>
            </div>
            <?php echo "<div class='heading-cats' id='montagnes-head'>
                    <h3>MONTAGNES</h3>
                    <p class='heading-cat-description'>Des randonn&eacute;es de plus de 6 heures et de haute difficult&eacute;</p>
                  </div>";
            ?>
            <div class='cat-content' id='montagnes'>
            <?php foreach($montagnes as $montagne){
                    echo "<h4>$montagne->nom</h4><br>
                        $montagne->description<br>
                        <b>Location:</b> {$montagne->location} <br>
                        <b>Dur&eacute;e:</b> {$montagne->duration} heures<br>
                        <b>Prix(par personne):</b> {$montagne->prix}&euro;<br></p>";
           }?>
            </div>
		</section>
		<?php include('php/footer.php');?>
		<script>
		$(document).ready(function(){
			  $("#promenades-head").click(function(){
			    $("#promenades").toggle();
			  });
		
			  $("#marches-head").click(function(){
			    $("#marches").toggle();
			  });

			  $("#montagnes-head").click(function(){
			    $("#montagnes").toggle();
			  });
		});
		</script>
	</body>
</html> 