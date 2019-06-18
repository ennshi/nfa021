<?php
require_once 'php/init.php';
if(empty($_SESSION['name'])){
    header('Location: index.php');
} else if(empty($_SESSION['permission'])&&(time()-$_SESSION['auth_time'] > 100000)){
    header('Location: php/logout.php');
} else if(empty($_SESSION['permission'])&&(time()-$_SESSION['auth_time'] < 100000)) {
    header('Location: account.php');
}
else {
    $user = new User;
    $userIds = $user->userIds();
    $chat = new Communication();
}

?>
<!DOCTYPE html>
<html>
    <head>
		<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="robots" content="noindex" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<link rel="stylesheet" href="css/style.css" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<title>Les Pyrenees Vertes - agence de voyage</title>
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.0.min.js"></script>
	</head>
	<body>
		<?php include('php/nav.php');?>
			<div id="admin-page">
				<div id="admin-header">
        			<h1 id="admin-head">Bonjour, <?=$_SESSION['name']?> </h1>
            		<a href="history.php"><button class="btn admin-btn" >Historique</button></a>
            		<a href="php/pdf_file.php"><button class="btn admin-btn" >PDF</button></a>
            		<a href="php/logout.php"><button class="btn admin-btn" >Se d&eacute;connecter</button></a>
            	</div>
        		<div id="users">
        		<?php 
        		echo "<table>
                    <caption>Users</caption>
                    <thead>
                        <tr>
                            <th scope='col'>#</th>
                        	<th scope='col'>Id</th>
                        	<th scope='col'>Nom</th>
                        	<th scope='col'>Pr&eacute;nom</th>
                        	<th scope='col'>Email</th>
                        	<th scope='col'>Date d'inscription</th>
                        	<th scope='col'>Permission</th>
                            <th scope='col'></th>
                        </tr>
                    </thead><tbody>";
                $x = 1;
        		foreach($userIds as $userId){
        		    $user->find($userId->id);
        		    $id = $user->data()->id;
        		    $nom = $user->data()->nom;
        		    $prenom = $user->data()->prenom;
        		    $email = $user->data()->email;
        		    
        		    $chat->select_chat($id);
        		    $messages = count($chat->data());
        		    echo"<tr>
                        <td scope='row' data-label=\"#\">{$x}</td>
            		    <td data-label=\"Id\">{$id}</td>
            		    <td data-label=\"Nom\">{$nom}</td>
            		    <td data-label=\"Pr&eacute;nom\">{$prenom}</td>
            		    <td data-label=\"Email\">{$email}</td>
            		    <td data-label=\"Date d'inscription\">{$user->data()->date_reg}</td>
            		    <td data-label=\"Permission\">{$user->data()->permission}</td>
                        <td class=\"but\" data-label=\"\"><input type='button' class='sidebtn' onclick='openUpdate({$id}, \"{$nom}\", \"{$prenom}\", \"{$email}\")' value='Modifier'> 
                                <input type='button' class='sidebtn' onclick='checkDelete({$id})' value='Supprimer'>
                                <input type='button' class='sidebtn' onclick='window.location.href=\"account.php?customer={$id}\"' value='Chat({$messages})'></td>
        		    </tr>";
        		    $x++;
        		}
        		echo "</tbody></table>";
        		?>
        		<?php include('php/footer.php');?>
        	</div>
    		<div class="form-popup" id="updateForm">
              <form action="" class="form-container">
                <h2>Modifier #<span id="num_user"></span></h2>
            	
            	<label for="nom">Nom</label>
    			<input type="text" name="nom" id="nom" value="" autocomplete="off"><br>
    		
    			<label for="prenom">Prenom</label>
    			<input type="text" name="prenom" id="prenom" value="" autocomplete="off"><br>
            	
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="" autocomplete="off"><br>
            
                <button type="button" class="btn" id="submitBtn">Modifier</button>
                <button type="button" class="btn" onclick="cancelUpdate()">Annuler</button>
              </form>
            </div>
        </div>
	<script>
	function checkDelete(id){
		if($('#updateForm').css('display') == 'block'){
			cancelUpdate();
		}	
		const num = id;
		let msg = confirm("Voulez-vous supprimer l'utilisateur id=" + num +"?");
		if(msg) {
			$.ajax({  
			    type: 'POST',  
			    url: 'php/delete.php', 
			    data: { user: num }
			    
			})
			.done(function(data){
				alert(data);
				window.location.reload();
			});
		}
	}
	function openUpdate(id, nom, prenom, email){
		if($('#updateForm').css('display') == 'none'){
    		const num = id;
    		$('#num_user').html(num);
    		$('#nom').val(nom);
    		$('#prenom').val(prenom);
    		$('#email').val(email);
    		
    		$('#updateForm').css('display','block');
    
    		$('#submitBtn').click(function(){
        		let msg = confirm("Voulez-vous modifier l'utilisateur id=" + num + "?");
        		if(msg) {
        			let formData = {
        	    			'id' : num,
        		            'nom' : $('input[name=nom]').val(),
        		            'prenom' : $('input[name=prenom]').val(),
        		            'last_email' : email,
        		            'email' : $('input[name=email]').val()
        		        };
        			$.ajax({  
        			    type: 'POST',  
        			    url: 'php/update.php', 
        			    data: formData
        			    
        			})
        			.done(function(data){
        				alert(data);
        				window.location.reload();
        			});
        		}
    		});
		}
	}
	function cancelUpdate(){
		$("#updateForm").css("display","none");
	}
	</script>
	</body>
</html>