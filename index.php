<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Exercice PHP</title>
  </head>
  <body>
    <?php
      try
      {
      	$bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', 'choupette',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      }
      catch(Exception $e)
      {
              die('Erreur : '.$e->getMessage());
      }
    ?>
    <p>
    <strong>Clients</strong> : </p>
    <?php
      $reponse = $bdd->query('SELECT * FROM clients');
      while ($donnees = $reponse->fetch())
      {
        echo '<ul>';
       echo '<li>'.$donnees['firstName'].' '.$donnees['lastName'].'</li>';
       echo '</ul>';
       }
       $reponse->closeCursor();
      ?>
      <p><strong>Types de spectacles :</strong></p>
      <?php
       $reponse = $bdd->query('SELECT * FROM showTypes');
       while ($donnees = $reponse->fetch())
       {
         echo '<ul>';
         echo '<li>'.$donnees['type'].'</li>';
         echo '</ul>';
       }
       $reponse->closeCursor();
     ?>
     <p><strong>Les 20 premiers clients :</strong></p>
     <?php
     $reponse = $bdd->query('SELECT firstName FROM clients LIMIT 0, 20');
      while ($donnees = $reponse->fetch())
      {
          echo $donnees['firstName'] . '<br />';
      }
$reponse->closeCursor();
      ?>
      <p><strong>Les clients possédant une carte de fidélité :</strong></p>
      <?php
      $reponse = $bdd->query('SELECT firstName FROM clients WHERE card=1');
      while ($donnees = $reponse->fetch())
      {
        echo $donnees['firstName'] . ' est un client fidèle<br />';
      }
      $reponse->closeCursor();
       ?>
       <p><strong>Les client dont le nom commence par M :</strong></p>
       <?php
       $reponse=$bdd->query("SELECT lastName, firstName FROM clients WHERE lastname LIKE 'M%' ORDER BY lastName");
       while ($donnees=$reponse->fetch())
       {
         echo 'Nom : '.$donnees['lastName'].' Prénom : '.$donnees['firstName'].'<br/>';
       }
       $reponse->closeCursor();
        ?>
        <p><strong>Speactacle par artiste le date à heure :</strong></p>
        <?php
        $reponse=$bdd->query("SELECT * FROM shows");
        while ($donnees = $reponse->fetch())
        {
          echo '<ul>';
          echo '<li>'.$donnees['title'].' par '.$donnees['performer'].' le '.$donnees['date'].' à '.$donnees['startTime'].'</li>';
          echo '</ul>';
        }
        $reponse->closeCursor();
         ?>
         <p><strong>Dernier exo tout afficher :</strong></p>
         <?php
         $reponse = $bdd->query('SELECT * FROM clients');
         while ($donnees=$reponse->fetch())
         {
           echo "<ul>";
          echo "<li>Nom de famille : ".$donnees['lastName'].' Prénom : '.$donnees['firstName'].' Date de naissance : '.$donnees['birthDate'].' Carte de fidélite : ';
          if($donnees['card']==1){
            echo "Oui -> ".$donnees['cardNumber'].'</li>';
          }else{
            echo "Non </li>";
          }
          echo "</ul>";
         }
          ?>
  </body>
</html>
