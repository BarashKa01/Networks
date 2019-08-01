<?php // Index
session_start();

require 'lib/autoload.php';

$db = DBFarm::DBConnectionroot();
$projectManager = new ProjectManager($db);
$memberManager = new MemberManager($db);

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
		
		
			<div id="vide">
			
<?php
			//var_dump($_SESSION);
			//var_dump($_POST);
			if (isset($_POST["project_sectionh"]))
			{
				$listeprojects = $projectManager->getListProject();
			}
			elseif (isset($_POST["member_space"]))
			{
				if(session_status() == 2)
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
			}
	
			elseif (isset($_POST["menuabouth"]))
			{
				echo "Voici la page de présentation";
?>
				
				<div id="presentation">
				<h3>Présentez votre projet !</h3>
				<br />
				<h4>
				Présentez, proposez, suivez, améliorez</br>
				C'est ce que vous propose Netw0rks, une plate-forme de présentation pour votre projet.<br />
				</h4>
				<p>
				<strong>Presentez</strong> votre projet professionnel ou amateur, Netw0rks vous propose un réseau en pleine croissance pour votre projet, celui-ci aura une visibilité d'experts, d'amateurs, ou tout simplement de curieux désireux de connaitre vos talents. Votre publicité dont vous pouvez disposer comme bon vous semble.
				</p>
				<p>
				<strong>Proposez</strong> vos idées, un moyen efficace d'obtenir un retour général sur la viabilité de vos propositions, la communauté vous apportera complément et conseil, une forme de brainstorm afin de connaitre au mieux les attentes d'un spectre de la population.
				</p>
				<p>
				<strong>Suivez</strong> les projets qui vous intéressent, curieux ? recruteurs ? Envie d'apporter votre pierre à l'édifice ? Vous pourrez connaitre l'évolution des projets et de leurs auteurs sur votre espace membre. Inscrivez-vous c'est gratuit et rapide.
				</p>
				<p>
				<strong>Améliorez</strong> les projets, grâce à notre plate-forme, vous constuisez un réseau avec force de proposition, créer une synergie autour d'un projet, une collaboration ponctuelle ou continue mais d'une qualité qui vous conrrespondra. C'est dans ce but que Netw0rks vous offre la possibilité de créer, ensemble, vos idées de demain.
				</p>
				</div>
				
<?php
			}
			elseif (isset($_POST["menucontacth"]))
			{
				echo "Formulaire de contact";
			}
			else
			{
?>
				<p></p>
<?php
			}
?>
				<p></p>
				<p></p>
				<p></p>
				<p></p>
				<p></p>
				<p></p>
			</div>
		</section>
		
	</body>
	
	<footer>
	</footer>
</html>