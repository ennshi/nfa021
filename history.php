<?php 
require_once 'php/init.php'; 

if(time()-$_SESSION['auth_time'] > 10000){
    header('Location: php/logout.php');
}


function deleteHistory() {
    Historique::deleteURL();
}

if (isset($_GET['delete'])) {
    deleteHistory();
    echo "<script> window.location='admin.php'; </script>";
}

?>

<!DOCTYPE html>
<html>
    <head>
    	<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="css/style.css" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    	<title>Historique</title>
    </head>
    <body>
    	<?php include('php/nav.php');?>
    	<div id="admin-header">
    		<h1 id="admin-head">Historique</h1>
    		<a href='admin.php'><button class="btn admin-btn">Retour</button></a>
    		<a href='history.php?delete=true'><button class="btn admin-btn">Supprimer</button></a>
    	</div>
    	<section>
        	<?php 
    		echo "<table>
                <thead>
                    <tr>
                    	<th>URL</th>
                    </tr>
                </thead>";

            if(isset($_COOKIE['pageurl'])){
                foreach(Historique::get('pageurl') as $url){
        		    echo"<tr>
            		    <td>{$url}</td>
        		        </tr>";
                }
    		}
    		echo "</table>";
    		?>
		<?php include('php/footer.php');?>
		</section>
    </body>
</html>
