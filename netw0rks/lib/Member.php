<?php //Netw0rk's Member class

class Member
{

	protected $memberID,
		$memberAlias,
		$memberPresentation,
		$memberName,
		$memberLastName,
		$memberCreateDate,
		$memberLastConnection,
		$memberPassword,
		$memberPasswordConf,
		$memberMail,
		$memberErreurs = [];
		

	const ALIAS_INVALIDE = 1;
	const MAIL_INVALIDE = 2;
	const PASSWORD_INVALIDE = 3;
	const ENTREE_INVALIDE = 4;
	
	public function __construct(array $data)
	{
		if (!empty($data))
		{
			$this->hydrate($data);
		}	

	}
	
	public function hydrate(array $memberData)
	{
		foreach ($memberData as $key => $valeur)
		{
			$methode = 'set'.ucfirst($key);
			echo $methode,'.';
			if (method_exists ($this, $methode))
				{
					
					$this->$methode($valeur);
				}
				
		}
	}
		
	//GETTERS
	
	public function memberID()
	{
		return $this->memberID;
	}
	
	public function memberAlias()
	{
		return $this->memberAlias;
	}
	
	public function memberPresentation()
	{
		return $this->memberPresentation;
	}
	
	public function memberName()
	{
		return $this->memberName;
	}
	
	public function memberLastName()
	{
		return $this->memberLastName;
	}
	
	public function memberCreateDate()
	{
		return $this->memberCreateDate;
	}
	
	public function memberLastConnection()
	{
		return $this->memberLastConnection;
	}
	
	public function memberErreurs()
	{
		return $this->memberErreurs;
	}
	
	public function memberPassword()
	{
		return $this->memberPassword;
	}

	public function memberMail()
	{
		return $this->memberMail;
	}
	
	
	//SETTERS
	
	public function setPasswordconf($passwordconf)
	{
		if (preg_match("#[a-zA-Z0-9!?\#\-]#", $passwordconf))
		{
			$stpasswordconf = strip_tags($passwordconf);
			$this->memberPasswordConf = $stpasswordconf;
		}
		
		if ($this->memberPasswordConf == $this->memberPassword)
			{
				$password = $this->memberPassword;
				$passwordh = password_hash($password, PASSWORD_DEFAULT);
				$this->memberPassword = $passwordh;
			}
		else
			{
				$memberErreurs = self::PASSWORD_INVALIDE;
			}
		
	}
	
	public function setMemberPassword ($memberPassword)
	{
		if (preg_match("#[a-zA-Z0-9!?\#\-]#", $memberPassword))
		{
			$stpassword = strip_tags($memberPassword);
			$this->memberPassword = $stpassword;
		}
	}
	
	public function setMemberMail ($mail)
	{
		$mail = strip_tags($mail);
		
		if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $mail))
		{
			
				
			$this->memberMail = $mail;
		}
		else
		{
			$this->memberErreurs = self::MAIL_INVALIDE;
		}

	}

	
	public function setMemberAlias($memberalias)
	{
		
		
		if(preg_match("#^[a-zA-Z0-9]+$#", $memberalias))
		{
			$memberalias = strip_tags($memberalias);
			
			$this->memberAlias = $memberalias;
			
		}
		else
		{
			$this->memberErreurs = self::ALIAS_INVALIDE;
		}
	}
	public function setMemberPresentation($memberpresentation)
	{
		$memberpresentation = strip_tags($memberpresentation);
		
		if(is_string($memberpresentation) && !empty($memberpresentation))
		{
			$this->memberPresentation = $memberpresentation;
		}
		else
		{
			$empty = "vide";
			$this->memberPresentation = $empty;
		}
	}
	
	public function setMemberName($membername)
	{
		$membername = strip_tags($membername);
		$emptymembername = "vide";
		
		if(!isset($membername))
		{
			$this->memberName = $emptymembername;
		}
		else
		{
			$this->memberName = $membername;
		}
	}
	
	public function setMemberLastName($memberlastname)
	{
		$memberlastname = strip_tags($memberlastname);
		$emptymemberlastname = "vide";
		
		if($memberlastname === NULL)
		{
			$this->memberLastName = $emptymemberlastname;
		}
		else
		{
			$this->memberLastName = $memberlastname;
		}
	}
	
	public function setMemberCreateDate(string $date)
	{
		$this->memberCreateDate = $date;
	}

	public function setMemberLastConnection()
	{
		$today = new DateTime();
		$today = $today->format('Y-m-d H:i:s');

		$this->memberLastConnection = $today;
	}
	

	
	
	
	
	
}