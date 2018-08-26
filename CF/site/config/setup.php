<?php

include './db.php';
include './db-function.php';
session_start();
session_destroy();

	try
	{
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("CREATE DATABASE IF NOT EXISTS $DB_NAME");
		$bdd->query("use $DB_NAME");
		create_user_table($bdd);
		create_pictures_table($bdd);
		create_groups_table($bdd);
		create_article_table($bdd);
		create_selection_table($bdd);
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
	header('Location: ../web/Accueil');




?>
