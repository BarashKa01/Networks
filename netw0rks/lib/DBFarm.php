<?php // DBFarm Networks

class DBFarm

{
	public static function DBConnectionroot()
	
	{
		try
		{
			$db = new PDO('mysql:host=localhost;dbname=netw0rks', 'root', '');
		}
		catch (Exception $e)
		{
			die ("Erreur :".$e->getMessage());
		}
		
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		return $db;
	}
	
	public static function DBConnectionuser()
	
	{
		$db = new PDO('Mysql:host=localhost;dbname=netw0rks', 'user', '');
		$db->setAttribute(PDO::ATTR_MODE, PDO::ERRMODE_EXCEPTION);
		
		return $db;
	}
}
?>