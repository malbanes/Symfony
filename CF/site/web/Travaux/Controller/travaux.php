<?php
function add_article($pdo, $article)
{
  $request = "INSERT INTO article (titre,text1,text2) VALUES ('".$article['categorie']."','".$article['titre']."','".$article['text1']."','".$article['text2']."')";
  $prepare=$pdo->prepare($request);
  $prepare->execute();
}

	$titre=null;
if (isset($_GET["categorie"]))
{
	//vérifié que "catégorie" est valide
	$titre= addslashes($_GET["categorie"]);

	//get categorie
	
	try
	{
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("use $DB_NAME");

		$sql = "SELECT id_group FROM groups WHERE name='".$titre."'";
		$q = $bdd->prepare($sql);
		$q->execute();
		//$q->setFetchMode(PDO::FETCH_ACCOC);
		$r=$q->fetch();

	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}

	if ($r==NULL)
	{
		die("la catégorie ".$titre." n'existe pas.");
	}
	echo  "<h2 class='title-bordered'>".$titre."</h2>";

	//get categorie_article
	try
	{
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("use $DB_NAME");

		$sql = 'SELECT * FROM article WHERE id_group LIKE'.$id_cat;
		$q = $bdd->prepare($sql);
		$q->execute();
		while ($r = $q->fetch())
		{
			$tab[] = $r;
		}

	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}
else
{

	$titre = "Tous";
	   echo  "<h2 class='title-bordered'>".$titre."</h2>";
	//get tous les articles du plus récent au plus vieux
	try
	{
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("use $DB_NAME");
		$sql = "SELECT * FROM article ORDER BY 'id_article' DESC";
		$q = $bdd->prepare($sql);
		$q->execute();
		while ($r = $q->fetch())
		{
			if ($r!=NULL){
		  $render="<div class='article'><div class='flex'><h3 class='text-red'>";
		  $render=$render.$r['titre']."</h3>";
		  $render=$render."<button class='more'> plus... </button></div><div class='flex'>";
		  if ($r['text1']!=NULL)
		  {
		  	$render=$render."<div class='article-content'>";
		  	$render=$render.$r['text1']."</div>";
		  }
		  
		  if ($r['text2']!=NULL)
		  {
		  	$render=$render."<div class='article-content'>";
		  	$render=$render.$r['text2']."</div>";
		  }
		  $render=$render."</div></div></div>";
		  echo($render);}
		}

	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}



?>


