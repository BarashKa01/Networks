<?php // netw0rks SIGNUP's
session_start();

if (isset($Member) && !empty($Member))
{
$_SESSION['Alias'] = $Member->memberAlias();
}

require 'lib/autoload.php';



if (isset($_POST["signup"]))
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
			<div id="signup_form">
				<form method="post" action="signup.php">
					<label for="memberAlias">Nom d'utilisateur :</label>
					<input type="text" name="memberAlias" id="memberAlias" maxlength="30" required autofocus />
					<div class="password"><label for="memberPassword">Mot de passe :</label>
					<input type="password" name="memberPassword" id="memberPassword" required /></div>
					<div class="passwordconf"><label for="passwordconf">Confirmez votre mot de passe :</label>
					<input type="password" name="passwordconf" id="passwordconf" required /></div>
					<div class="mail"><label for="memberMail">Votre adresse e-mail :</label>
					<input type="text" name="memberMail" id="memberMail" required /></div>
					
					<input type="submit" value="S'inscrire" /></div>
				</form>
			</div>
						

<?php	
			}
			elseif (isset($_POST["memberAlias"]) && isset($_POST["memberPassword"]) && isset ($_POST["passwordconf"]) && isset($_POST["memberMail"]))
			{
			// CREATION DE L'OBJET "MEMBRE"
				

				
				
				
			// VERIFICATION ET INTEGRATION DU PSEUDO
				
			//VERIFICATION ET INTEGRATION DU PASSW
				
				if(!empty($_POST["memberPassword"] && $_POST["passwordconf"]) && $_POST["memberPassword"] === $_POST["passwordconf"])
				{
					$Member = new Member($_POST);
					var_dump($Member->memberMail());
					var_dump($Member->memberpassword());
					$DB = DBFarm::DBConnectionroot();
					$Manager = new MemberManager($DB);
				}
					

				else
				{
					echo "Nom d'utilisateur ou mot de passe incorrect";
						echo("
							<form action='index.php'>
							<input type='submit' value='Retour à l'accueil'>
							</form>
							");
					die();
				}
				
				
			// VERIFICATION ET INTEGRATION DU MAIL
				
				
				var_dump($Member);
				var_dump($_POST);

				$Manager->addMember($Member);
				
			var_dump($_SESSION['Alias']);
				
				echo "L'inscription a réussie";
?>
				<a href="member_space.php">Accédez à l'espace membre</a>
<?php

?>

				<form method="post" action="member_space.php">
				<input type="submit" name="member" value="Espace membre" />
				
				</form>

<?php
			}
			else
			{
				echo "Le système d'inscription n'a pas pu aboutir";
					echo("
						<form action='index.php'>
						<input type='submit' value='Retour'>
						</form>
						");
				var_dump($_POST);
				die();
			}

?>
		</section>
	</body>
</html>