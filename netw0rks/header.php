<?php //HEADER

//echo session_status();
?>
<?php

if(!empty($_SESSION['Alias']) && $_SESSION['Alias'] != null)
{?>

	<div id="TOPlogout">
		<div class="logout">
			<form method="post" action="logout.php">
				<input type="hidden" name="logout" value="plop" />
				<input type="image" name="deconnexion" value="Déconnexion" />
			</form>
		</div>
		
		<div class="prez">
			<h1>Netw0rks</h1>
		</div>
		<div class="myspace">
			<form method="post" action="member_space.php">
			<input type ="hidden" name ="member_space" value ="member_space" />
			<input type="image" name="member_space" value="Bonjour <?php echo $_SESSION['Alias'] ?>" />
			</form>
		</div>
	</div>
<?php
}
else
{
?>
	<div id="TOPlogout">
		<form method="post" action="signup.php">
		<div class="signup">
			<input type ="hidden" name ="signup" value ="signup" />
			<input type="image" name="signup" value="Inscription" />
		</div>
		</form>

		<div class="prez">
			<h1>Netw0rks</h1>
		</div>
		
		<form method="post" action="login.php">
		<div class="signin">
			<input type ="hidden" name ="login" value ="signin" />
			<input type="image" name="signin" value="Connexion" />
		</div>
		</form>
	</div>
<?php
}
?>

<div id="menu">
	<form method="post" action ="index.php">
	<div class="menuaccueil">
		<input type ="hidden" name ="menuaccueilh" value ="menuaccueil" />
		<input type="image" name="menuaccueil" value="Accueil" />
	</div>
	</form>
	
	<form method="post" action ="index.php">
	<div class="menuprojets">
		<input type ="hidden" name ="project_sectionh" value="menuprojets" />
		<input type="image" name="menuprojets" value="Projets" />
	</div>
	</form>
	
	<form method="post" action ="index.php">
	<div class="menuabout">
		<input type="hidden" name="menuabouth" value="menuabouth" />
		<input type="image" name="menuabout" value="A propos" />
	</div>
	</form>
	
	<form method="post" action ="index.php">
	<div class="menucontact">
		<input type="hidden" name="menucontacth" value="menucontacth" />
		<input type="image" name="menucontact" value="Contact" />
	</div>
	</form>
</div>