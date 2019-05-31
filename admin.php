<?php
require_once 'init.php';
if(!$_SESSION['permission']&&(time()-$_SESSION['auth_time'] > 100000)){
    header('Location: logout.php');
} else if(!$_SESSION['permission']&&(time()-$_SESSION['auth_time'] < 100000)) {
    header('Location: index.php');
}
else {
    $user = new User;
    $userIds = $user->userIds();
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Admin panel</title>
        <link rel="stylesheet" type="text/css" href="admin_style.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    </head>
	<body>
		<main>
    		<h1>Bonjour, admin </h1>
    		<a href="logout.php"><button id="logoutbtn" >Se d&eacute;connecter</button></a>
    		<a href="history.php"><button id="logoutbtn" >Historique</button></a>
    		<a href="pdf_file.php"><button id="logoutbtn" >PDF</button></a><br><br>
    		<?php 
    		echo "<table>
                <tr>
                    <th colspan=2><h2>Users</h2></th>
                    <th colspan=6></th>
                </tr>
                <tr>
                    <th>Numero</th>
                	<th>id</th>
                	<th>Nom</th>
                	<th>Prenom</th>
                	<th>Adresse electronique</th>
                	<th>Date registration</th>
                	<th>Permission</th>
                    <th></th>
                </tr>";
            $x = 1;
    		foreach($userIds as $userId){
    		    $user->find($userId->id);
    		    $id = $user->data()->id;
    		    $nom = $user->data()->nom;
    		    $prenom = $user->data()->prenom;
    		    $email = $user->data()->email;
    		    echo"<tr>
                    <td>{$x}</td>
        		    <td>{$id}</td>
        		    <td>{$nom}</td>
        		    <td>{$prenom}</td>
        		    <td>{$email}</td>
        		    <td>{$user->data()->date_reg}</td>
        		    <td>{$user->data()->permission}</td>
                    <td><input type='button' class='sidebtn' onclick='openUpdate({$id}, \"{$nom}\", \"{$prenom}\", \"{$email}\")' value='Modify'> 
                            <input type='button' class='sidebtn' onclick='checkDelete({$id})' value='Delete'></td>
    		    </tr>";
    		    $x++;
    		}
    		echo "</table>";
    		?>
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

		</main>
	<script>
	function checkDelete(id){
		if($('#updateForm').css('display') == 'block'){
			cancelUpdate();
		}	
		const num = id;
		let msg = confirm("Do you want to delete the user #" + num);
		if(msg) {
			$.ajax({  
			    type: 'POST',  
			    url: 'delete.php', 
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
        		let msg = confirm("Do you want to update the data of user #" + num);
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
        			    url: 'update.php', 
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