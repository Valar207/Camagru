<?php

require "./config/database_connect.php";

$username = $_GET['username'];
$cle = $_GET['cle'];

$sql = "SELECT cle,actif FROM users WHERE nameUsers like :username";
$req = $bdd->prepare($sql);
if($req->execute(array('username' => $username)) && $row =$req->fetch())
{
    $req->closeCursor();
    $clebdd = $row['cle'];
    $actif = $row['actif']; 
}

if($actif == '1') // Si le compte est déjà actif on prévient
  header("Location: ./index.php?actif=already");
else // Si ce n'est pas le cas on passe aux comparaisons
  {
      if($cle == $clebdd) // On compare nos deux clés    
       {
        // La requête qui va passer notre champ actif de 0 à 1
        $sql = "UPDATE users SET actif = 1 WHERE nameUsers like :username";
        $req = $bdd->prepare($sql);
        $req->execute(array('username' => $username));

        // Si elles correspondent on active le compte !    
        header("Location: ./index.php?actif=success");
       }
       else // Si les deux clés sont différentes on provoque une erreur...
        header("Location: ./index.php?actif=error");
  }
?>