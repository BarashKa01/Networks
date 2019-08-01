<?php // Netw0rks's MEMBER_SPACE
session_start();
//var_dump($_SESSION);

require 'lib/autoload.php';


?>

<DOCTYPE = html>
<html>

	<head>
		<meta charset="utf8" />
		<link rel="stylesheet" href="Style.css" />
		<title>Netw0rks - Votre espace membre</title>
	</head>
	
	<header>
		<?php include 'header.php'; ?>
	</header>

	<body>
		<section>
<?php 
	if(session_status() == 2 || isset($_POST['member_space']))
	{
?>
			<div id="memberlookup">
				
				<p>Les informations du membre</p>
				<p>Avec les possibilités d'afficher publiquement ou non les informations (par checkbox)</p>
				
			</div>
			
			<div id="memberavatar">
				
				<p>L'espace avatar du membre</p>
				
			</div>
			
			<div id="memberportrait">
				
				<p>La présentation du membre</p>
				
			</div>
<?php
	}
	else
	{
		echo "Votre session a expirée";
	}
?>
		
		</section>
		
		
	
	
	</body>



</html>