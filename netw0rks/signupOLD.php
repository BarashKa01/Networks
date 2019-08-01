<?php // netw0rks SIGNUP's

require 'lib/autoload.php';

if (isset($_POST["signup"]))
{
	echo "Formulaire d'inscription";
	
	var_dump($_POST["signup"]);
?>

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
	
	$Member = new Member;
	$DB = DBFarm::DBConnectionroot();
	$Manager = new MemberManager($DB);
	
	
	
// VERIFICATION ET INTEGRATION DU PSEUDO
	
	if(!empty($_POST["memberAlias"]))
	{
		if(preg_match("#^[a-zA-Z0-9]+$#", $_POST["memberAlias"]))
		{
			$pseudo = strip_tags($_POST["memberAlias"]);
			
			$Member->setMemberAlias($pseudo);
			
		}
		
	}
	else
	{
		echo "Nom d'utilisateur ou mot de passe incorrect";
	}
	
//VERIFICATION ET INTEGRATION DU PASSW
	
	if(!empty($_POST["memberPassword"] && $_POST["passwordconf"]))
	{
		if ($_POST["memberPassword"] === $_POST["passwordconf"] && preg_match("#^[a-zA-Z0-9](8,)$#", $_POST["memberPassword"]))
			{
				$password = strip_tags($_POST["memberPassword"]);
				$passwordh = password_hash($password, PASSWORD_DEFAULT);
				
				$Member->setMemberPassword($passwordh);
				
			}
		
	}
	else
	{
		echo "Nom d'utilisateur ou mot de passe incorrect";
	}
	
	
// VERIFICATION ET INTEGRATION DU MAIL
	
	if(!empty($_POST["memberMail"]))
	{
		if (preg_match("#^[a-zA-Z0-9.-_]+@[a-zA-Z0-9._-](2,)\.[a-z0-9](2,4)$#", $_POST["memberMail"]))
		{
			$mail = strip_tags($_POST["memberMail"]);
			
			$Member->setMemberMail($mail);
		}
	}
	else
	{
		echo "Les informations que vous avez communiqué sont incorrectes, déjà inscrit ?";
		echo "bouton Login";
	}

	var_dump($Member);
	var_dump($_POST);
	$Manager->addMember($Member);
	
	echo "L'inscription a réussie";
}
else
	{
		echo "Le système d'inscription n'a pas pu aboutir";
		var_dump($_POST);
	}

?>