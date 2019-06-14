<?php
require_once 'php/init.php';
if(empty($_SESSION['name'])){
    header('Location: index.php');
} else if(time()-$_SESSION['auth_time'] > 100000){
    header('Location: logout.php');
} else if(isset($_SESSION['permission'])&&(time()-$_SESSION['auth_time'] < 100000)&&!isset($_GET['customer'])) {
    header('Location: admin.php');
} else{
    $customer = '';
    $chat = new Communication();
    if(isset($_GET['customer'])&&isset($_SESSION['permission'])){
        $customer = $_GET['customer'];
        $chat->select_chat($_GET['customer']);
    }else{
        $chat->select_chat($_SESSION['id']);
    }
    $messages = $chat->data();
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
		<title>Les Pyrenees Vertes - agence de voyage</title>
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.0.min.js"></script>
	</head>
	<body>
		<?php include('php/nav.php');?>
		<div id="admin-page">
    		<div id="admin-header">
    			<h1 id="admin-head">Bonjour, <?=$_SESSION['name']?></h1>
    			<?php 
				  if(isset($_SESSION['permission'])){
        		    echo "<a href=\"admin.php\"><button class=\"btn admin-btn\">Retour</button></a>";
				    }
        		?>
        		<a href="history.php"><button class="btn admin-btn">Historique</button></a>
        		<a href="php/logout.php"><button class="btn admin-btn">Se d&eacute;connecter</button></a>
    		</div>
    		<div id="chat" class="container">
        		<table>
            		<?php foreach($messages as $message){
            		    if($message->sent_from == 0){
            		        $nom = "admin";
            		    }else{
            		        $user_sent = new User();
            		        $user_sent->find($message->sent_from);
            		        $nom = $user_sent->data()->prenom;
            		    }
            		    $text = $message->message_text;
            		    $date_time = $message->date_sent;
            
            		    echo"<tr>
                            <td><span class=\"sender\">{$nom}:</span></td>
                		    <td>{$text}</td>
                		    <td>{$date_time}</td>
            		    </tr>";
    		            }
    		       ?>
        		</table>
        	</div>
    		<form>
        		<input id='text' type='text' name='message_sent' value='' placeholder="Votre message">
        		<input type="submit" class="btn" value="Send"><br>
        		<input type="hidden" name="userId" value='<?php echo $_SESSION['id'];?>'>
        		<input type="hidden" name="custId" value='<?php echo $customer;?>'>
    		</form>
    		<?php include('php/footer.php');?>
		</div>
		<script>
    		$(document).ready(function() {
    			let chat = $('#chat');
    		    let height = chat[0].scrollHeight;
    		    chat.scrollTop(height);
    		    
    		    $('form').submit(function(event) {
    				let idFrom = $('input[name=userId]').val();
    				let idTo;
    				if(idFrom != 0){
    					idTo = 0;
    				}else{
    					idTo = $('input[name=custId]').val();
    				}
    		       	
    		        let formData = {
            	    			'id_sender' : idFrom,
            	    			'id_receiver' : idTo,
            		            'message' : $('input[name=message_sent]').val()
            		        };
    		        $.ajax({
    		            type        : 'POST', 
    		            url         : 'php/send_message.php', 
    		            data        : formData, 
    
    		            success: function(){
    		            	$('input[name=message_sent]').val('');
    		            	window.location.reload();
    	
    		            }
        			});
    		        event.preventDefault();
    		    });
    
    		});
		</script>
	</body>
</html>
