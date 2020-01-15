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
    cle VARCHAR(52),
    img varchar(255) NOT NULL DEFAULT './profile_pics/default_profile.jpg',
    bio text,
    img_nbr int (11) NOT NULL DEFAULT 0
    );";
$req = $bdd->prepare($sql);
if ($req->execute())
    echo "Users table successfully created.\n<br>";
$req->closeCursor();


$sql = "CREATE TABLE `pictures` (
    `id_img` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `id_user` int(11) NOT NULL,
    `img` varchar(255) NOT NULL,
    `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `like` int(11) NOT NULL DEFAULT '0',
    FOREIGN KEY id_user(id_user)
    REFERENCES users(idUsers)
  );";
$req = $bdd->prepare($sql);
if ($req->execute())
    echo "Pictures table successfully created.\n<br>";
$req->closeCursor();

$sql = "CREATE TABLE `comments` (
    `id_com` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `id_user` int(11) NOT NULL,
    `id_img` int(11) NOT NULL,
    `comment` text,
    `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY id_user(id_user)
    REFERENCES users(idUsers),
    FOREIGN KEY id_img(id_img)
    REFERENCES pictures(id_img)
  );";
$req = $bdd->prepare($sql);
if ($req->execute())
    echo "Comments table successfully created.\n<br>";
$req->closeCursor();
?>