<?php // Netw0rk's Member Manager
class MemberManager
{
	protected $MemberDB;

	public function __construct ($DB)
	{
		$this->setMemberDB($DB);
	}

	public function setMemberDB (PDO $db)
	{
		$this->MemberDB = $db;
	}
	
	public function addMember(Member $member)
	{
		$emptydata = 'Non renseigné';
		$member->setMemberPresentation($emptydata);
		$member->setMemberName($emptydata);
		$member->setMemberLastName($emptydata);
		$requete = $this->MemberDB->prepare('INSERT INTO members (memberAlias, memberCreateDate, memberLastConnection, memberMail, memberPassword, memberPresentation, memberName, memberLastName) VALUES (:memberAlias, NOW(), NOW(), :memberMail, :memberPassword, :memberPresentation, :memberName, :memberLastName)');
		
		$requete->bindValue(':memberAlias', $member->memberAlias());
		$requete->bindValue(':memberMail', $member->memberMail());
		$requete->bindvalue(':memberPassword', $member->memberPassword());
		$requete->bindValue(':memberPresentation', $member->memberPresentation());
		$requete->bindValue(':memberName', $member->memberName());
		$requete->bindValue(':memberLastName', $member->memberLastName());
		
		try
		{
			$requete->execute();
		}
		catch (Exception $e)
		{
			die("Erreur :".$e->getMessage());
		}
	}
	
	public function setSessionInfo(Member $membre)
	{			
		session_start();
		$_SESSION['Alias'] = $membre->memberAlias();
		$_SESSION['name'] = $membre->memberName();
		$_SESSION['lastName'] = $membre->memberLastName();
		$_SESSION['lastConnection'] = $membre->memberLastConnection();

			return $_SESSION;		
	}

	public function unsetSessionInfo()
	{			
		session_start();
		unset($_SESSION['Alias']);
		unset($_SESSION['name']);
		unset($_SESSION['lastName']);
		unset($_SESSION['lastConnection']);

		session_destroy();			
	}

	public function checkMember(string $mail, string $pass)
	{
		$retour = false;

		$searchUser = $this->MemberDB->prepare('SELECT * FROM members WHERE memberMail = :mail');
		$searchUser->bindValue(':mail', $mail);

		try
		{
			$searchUser->execute();
		}
		catch(Exception $e)
		{
			die('Erreur !'. $e->getMessage());
		}

		while($donnees = $searchUser->fetch())
		{
			if ($donnees['memberMail'] == $mail AND  password_verify($pass, $donnees['memberPassword']) == true )
			{
				$retour = true;
			}
		}

		return $retour;
	}

	public function setMember (string $mail)
	{
		

		$searchUser = $this->MemberDB->prepare('SELECT * FROM members WHERE memberMail = :mail');
		$searchUser->bindValue(':mail', $mail);
		try
		{
			$searchUser->execute();
		}
		catch(Exception $e)
		{
			die('Erreur !'. $e->getMessage());
		}

		$datarray = $searchUser->fetch();

		$member = new Member($datarray);

		return $member;


	}
	
	public function editMember($id)
	{
		$sql = NULL;
		$intid = (int)$id;
		
		if (isset($_POST[edit_memberName]))
		{
			$sql = 'UPDATE members (name) VALUES (:name) WHERE id= :id';
			$newname = htmlspecialchars($_POST[edit_name]);
			
			$requete = bindValue(':id', $intid);
			$requete = $this->projectDB->prepare($sql);
			$requete = bindValue(':name', $newname);
			$requete->execute();
		}
		elseif (isset ($_POST[edit_memberPresentation]))
		{
			$sql = 'UPDATE members (presentation) VALUES (:presentation) WHERE id = :id';
			$newprez = htmlspecialchars($_POST[edit_presentation]);
			
			$requete = bindValue(':id', $intid);
			$requete = bindValue(':presentation', $newprez);
			$requete = $this->projectDB->prepare($sql);
			$requete->execute();
		}
		elseif (isset($_POST[edit_memberPassword]))
		{
			$sql = 'UPDATE members (memberPassword) VALUES (:memberPassword) WHERE id = :id';
			$newpassword = htmlspecialchars($_POST[edit_memberPassword]);
			
			$requete = bindValue(':id', $intid);
			$requete = bindValue(':memberPassword', $newpassword);
			$requete = $this->projectDB->prepare($sql);
			$requete->execute();
		}
		else
		{
			echo "Impossible d'éditer le projet";
		}
		
	}
	
	public function countMembers()
	{
		return $this->DB->query('SELECT COUNT (*) FROM members')->fetchColumn();
	}
	
	public function getLastMembers()
	{
		$requete = $this->DB->query('SELECT memberAlias, FROM members ORDER BY DESC LIMIT 0, 5');
		
		$requete = setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'member');
		$listeprojet = $requete->fetchAll();
		
		foreach ($listemember as $member)
		{
			$listemember[] = $member;
		}
	}
	
	public function displayMember($id)
	{
		$intid = (int)$id;
		
		$requete = $this->DB->query('SELECT name, autor, content, type, dateAjout, dateModif FROM projects WHERE id = :id');
		$requete->bindValue(':id', $intid, PDO::PARAM_INT);
		$requete->execute();
		
		$requete = setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Project');
		
		$project = $requete->fetch();
		return $project;		
	}
}

?>