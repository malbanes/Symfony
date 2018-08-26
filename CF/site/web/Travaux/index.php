<?php
		session_start();
	include("../../config/db.php");
?>

<!DOCTYPE html>
<HTML>

<HEAD>
	<?php include("../Ressources/view/head.html"); ?>
</HEAD>

<BODY>
	<?php include("../Ressources/view/header-1.html"); ?>

	
   <div class="container-static">


   <?php 

			
	if (isset($_GET["id"]))
		{include("./Controller/details.php");}
	elseif (isset($_GET["categorie"]))
		{include("./Controller/travaux.php");}
	else
		{include("./Controller/travaux.php");

    }
   ?>
  </div>


	<?php include("../Ressources/view/footer.html"); ?>
</BODY>
