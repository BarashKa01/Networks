<?php // Netw0rks project class


class Project
{
	protected $projectName,
		$projectID,
		$projectAutor, //memberID
		$projectContent,
		$projectPostDate,
		$projectUpdateDate,
		$projectErreurs[],
		$projectType;
		
	const PROJECTNAME_INVALIDE = 1;
	const PROJECTCONTENT_INVALIDE = 2;
	const PROJECTTYPE_INVALIDE = 3;
	
	public function __construct ($data = [])
	{
		if (!empty($data))
		{
			$this->hydrate($data);
		}
		else
		{
			echo "La construction n'a pu s'effectuer correctement";
		}
	}
	
	public function hydrate ($projectData)
	{
		foreach($projectData as $key => $valeur)
		{
			$methode = 'set' .ucfirst($key);
			if (is_callable([$this, $methode]))
			{
				$this->$methode($valeur);
			}
		}
	}
	
	// GETTERS
	
	public function projectID()
	{
		return $this->projectID;
	}
	
	public function projectName()
	{
		return $this->projectName;
	}
	
	public function projectAutor()
	{
		return $this->projectAutor;
	}
	
	public function projectContent()
	{
		return $this->projectContent;
	}
	
	public function projectPostDate()
	{
		return $this->projectpostDate;
	}
	
	public function projectUpdateDate()
	{
		return $this->projectUpdateDate;
	}
	
	public function projectType()
	{
		return $this->projectType;
	}
	
	public function projectErreurs()
	{
		return $this->projectErreurs;
	}
	
	
	//SETTERS
		
		
	public function setProjectName($projectname)
	{
		$projectname = htmlspecialchars($projectname);
		
		if (!is_string $projectname || is_empty($projectname))
		{
			$this->projectErreurs[] = self::PROJECTNAME_INVALIDE;
		}
		else
		{
			$this->projectName = $projectname;
		}
	}
	
	public function setProjectAutor()
	{
		
	}
	
	public function setProjectContent($projectcontent)
	{
		$projectcontent = strip_tags($projectcontent);
		
		if (is_string($projectcontent) && !empty($projectcontent))
		{
			$this->projectContent = $projectcontent;
		}
		else
		{
			$this->projectErreurs[] = self::PROJECTCONTENT_INVALIDE;
		}
	}
	
	public function setProjectUpdateDate(DateTime $projectUpdateDate)
	{
		$this->projectUpdateDate = $projectUpdateDate;
	}
	
	public function setProjectType($projectType)
	{
		$projectType = strip_tags($projectType);
		
		if (!is_string($projectType) | empty($projectType))
		{
			$this->projectErreurs[] = self::PROJECTTYPE_INVALIDE;
		}
		else
		{
			$this->projectType = $projectType;
		}
	}
	
}