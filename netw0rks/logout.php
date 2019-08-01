<?php // netw0rks LOGOUT's
//session_start();
//session_destroy();
var_dump($_POST);
var_dump($_SESSION);
?>

<DOCTYPE = html>
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
<?php		

			if(isset($_POST["logout"]) && $_POST["logout"] == 'plop')
			{

				try
				{
					$db = new PDO("mysql:host=localhost;dbname=netw0rks;charset=utf-8', 'root',''");
				}
				catch(Exception $e)
				{
					echo 'Erreur :'.$e->getMessage();
				}


				$unsetSession = new MemberManager($db);
				$unsetSession->unsetSessionInfo();
				
				echo "La connexion est terminée";
				var_dump($_SESSION);
				echo("
					<form action='index.php'>
					<input type='submit' value='Retour à l'accueil'>
					</form>
					");
					header('Location: index.php');
			}
			else
			{
				echo $_POST["logout"];
				echo "La connexion n'a pas pu se terminer";
				
				echo("
					<form action='index.php'>
					<input type='submit' value='retour'>
					</form>
					");
			}


?>

		</section>
	</body>
</html>
