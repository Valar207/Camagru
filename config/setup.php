<?PHP

require "database.php";

try
{
    $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $options);
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$sql = "CREATE DATABASE IF NOT EXISTS camagru";
$req = $bdd->prepare($sql);
if ($req->execute())
    echo "camagru database successfully created.\n<br>";
$req->closeCursor();

try
{
    $DB_DSN = "mysql:host=localhost;dbname=camagru;charset=utf8";
    $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $options);
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$sql = "CREATE TABLE users (
    idUsers int (11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nameUsers TINYTEXT NOT NULL, 
    emailUsers TINYTEXT NOT NULL,
    pwdUsers LONGTEXT NOT NULL,
    actif BIT NOT NULL DEFAULT 0,
    cle VARCHAR(52)
    );";
$req = $bdd->prepare($sql);
if ($req->execute())
    echo "Users table successfully created.\n<br>";
$req->closeCursor();



// $req = $bdd->prepare('SELECT nom FROM jeux_video WHERE possesseur = :possesseur');
// $req->execute(array('possesseur' => $_GET['possesseur']));
// $donnees = $req->fetch();

// echo '<ul>';
// while ($donnees = $req->fetch())
// 	echo '<li>' . $donnees['nom'];
// echo '</ul>';

// $req->closeCursor();
?>