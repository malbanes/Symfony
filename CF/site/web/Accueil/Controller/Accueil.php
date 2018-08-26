<?php

chercher dans la db les 10 photos


	try{
	include './../config/db.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE contreface");
		$requete = $bdd->prepare("SELECT `members_login` FROM `groups_relation` WHERE `group_key`= :key");
		
		$requete->bindParam(':key', $key);
		$requete->execute();
		$code = $requete->fetchall();
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
	foreach ($code as $tmp)
	{
		$tab_members[] = $tmp[0];
	}
	return ($tab_members);

