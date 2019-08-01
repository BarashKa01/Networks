<?php //netw0rks LOGIN's
//session_start();

require 'lib/autoload.php';

$db = DBFarm::DBConnectionroot();

	if (isset($_POST["login"]) && !isset($_POST['mail']) AND !isset($_POST['passw']))
	{

?>
	<!DOCTYPE = html>
	<html>
		
		<head>
			<meta charset="utf8" />
			<link rel="stylesheet" href="Style.css" />
			<title>Netw0rks</title>
		</head>
		
		<body>
			<header>
			<?php include "header.php"; ?>
			</header>
			
			<section>
		
						<div id="login_form">
							<form method="post" action="login.php">
								<div class="mail"><label for="mail">Votre adresse e-mail :</label>
								<input type="text" name="mail" id="mail" required /></div>
								<div class="password"><label for="passw">Mot de passe :</label>
								<input type="password" name="passw" id="passw" required /></div>
								
								<input type="submit" value="Connexion" /></div>
							</form>
						</div>
				
<?php	
	}
	elseif (isset($_POST['mail']) AND isset($_POST['passw'])) // Si l'identifiant et mdp rentré
	{
		$mail = NULL;
		$password = strip_tags($_POST['passw']);

		if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['mail']))
		{
			$mail = strip_tags($_POST['mail']);
		}
		else
		{
			die ("Format d'adresse mail non reconnu.");
		}


		$manager = new memberManager($db);
		//session_start();
		
		$user_conn = NULL;

		if($manager->checkMember($mail, $password) == true)
		{
			$user_conn = $manager->setMember($mail);
			$_SESSION = $manager->setSessionInfo($user_conn);

			//die (var_dump($_SESSION, $user_conn));

			header('Location: member_space.php');
		}
		
	}
	else
	{
		echo "Ca ne marche pas !";
		var_dump($_POST);
	}


?>
			</section>
		</body>
	</html>
