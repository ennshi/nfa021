<?php 
require_once 'init.php'; 

if(time()-$_SESSION['auth_time'] > 600){
    header('Location: logout.php');
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
    	<title>Historique</title>
    	<meta charset="utf-8">
    	<link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    	<main>
    		<h1>Historique</h1>
        	<?php 
    		echo "<table>
                <tr>
                    <th>Numero</th>
                	<th>URL</th>
                </tr>";
            $x = 1;

            if(isset($_COOKIE['pageurl'])){
                foreach(Historique::get('pageurl') as $url){
        		    echo"<tr>
                        <td>{$x}</td>
            		    <td>{$url}</td>
        		        </tr>";
        		    $x++;
                }
    		}
    		echo "</table>";
    		echo "<a href='admin.php'><button id='button'>Retour</button></a><br><br>";
    		echo "<a href='history.php?delete=true'><button id='button'>Supprimer</button></a><br><br>";
    		?>
		</main>
    </body>
</html>
