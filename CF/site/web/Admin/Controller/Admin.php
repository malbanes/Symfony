<?php


function add_article($pdo, $article)
{
  $request = "INSERT INTO ARTICLE (id_group,titre,text1,text2) VALUES (".$article[categorie].",".$article[titre].",".$article[text1].",".$article[text2].")";
  
  $prepare=$pdo->prepare($request);
  $prepare->execute();
}


?>
