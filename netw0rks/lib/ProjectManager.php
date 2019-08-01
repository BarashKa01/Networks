<?php // Netw0rk's project Manager

class ProjectManager
{
	protected $projectDB;
	
	public function __construct(PDO $DB)
	{
		$this->projectDB = $DB;
	}
	
	public function addProject(Project $projet)
	{
		$requete = $this->projectDB->prepare('INSERT INTO projects (name, autor, presentation, postDate, updateDate, type) VALUES (:name, :autor, :presentation, NOW(), NOW(), :type)');
		
		$requete = bindValue(':name', $projet->name());
		$requete = bindValue(':autor', $projet->autor());
		$requete = bindvalue(':presentation', $project->presentation());
		$requete = bindValue(':type', $project->type());
		
		$requete->execute();
	}
	
	public function editProject($id)
	{
		$sql = NULL;
		$id = (int)$id;
		
		if (isset($_POST[edit_name]))
		{
			$sql = 'UPDATE project (name) VALUES (:name) WHERE id= :id';
			$newname = htmlspecialchars($_POST[edit_name]);
			
			$requete = bindValue(':id', $id);
			$requete = $this->projectDB->prepare($sql);
			$requete = bindValue(':name', $newname);
			$requete->execute();
		}
		elseif (isset ($_POST[edit_presentation]))
		{
			$sql = 'UPDATE project (presentation) VALUES (:presentation) WHERE id = :id';
			$newprez = htmlspecialchars($_POST[edit_presentation]);
			
			$requete = bindValue(':id', $id);
			$requete = bindValue(':presentation', $newprez);
			$requete = $this->projectDB->prepare($sql);
			$requete->execute();
		}
		elseif (isset($_POST[edit_type]))
		{
			$sql = 'UPDATE project (type) VALUES (:type) WHERE id = :id';
			$newtype = htmlspecialchars($_POST[edit_type]);
			
			$requete = bindValue(':id', $id);
			$requete = bindValue(':type', $newtype);
			$requete = $this->projectDB->prepare($sql);
			$requete->execute();
		}
		else
		{
			echo "Impossible d'éditer le projet";
		}
		
	}
	
	public function countProject()
	{
		return $this->projectDB->query('SELECT COUNT (*) FROM projects')->fetchColumn();
	}
	
	public function getListProject()
	{
		
		if (empty($this->projectDB))
		{
			echo "Aucun projet à afficher";
		}
		else
		{
			try
			{
				$requete = $this->projectDB->query('SELECT name, autor, content, type FROM projects ORDER BY DESC LIMIT 0, 10');
			
				$requete = setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Project');
				$listeprojet = $requete->fetchAll();
				
				foreach ($listeprojet as $projet)
				{
					$listeprojet[] = $projet;
				}
			}
			catch(Exception $e)
			{
				echo "Pas de projet à afficher, alimentez la base :-)";
			}

		}
	}
	
	public function displayProject($id)
	{
		$intid = (int)$id;
		
		$requete = $this->projectDB->query('SELECT name, autor, content, type, dateAjout, dateModif FROM projects WHERE id = :id');
		$requete->bindValue(':id', $intid, PDO::PARAM_INT);
		$requete->execute();
		
		$requete = setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Project');
		
		$project = $requete->fetch();
		return $project;		
	}
	
}


?>