<?PHP
require "database.php";
try
{
    $DB_DSN = "mysql:host=localhost;dbname=camagru;charset=utf8";
    $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $options);
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}