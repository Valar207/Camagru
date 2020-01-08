<?PHP
session_start();
require "./config/database_connect.php";

$_SESSION['mail'] = $_GET['username'];
$mail = $_SESSION['mail'];
$token = $_GET['cle'];

$sql = "SELECT * FROM users WHERE emailUsers= :mail AND cle = :token";
$req = $bdd->prepare($sql);
$req->execute(array('mail' => $mail, 'token' => $token));

if($req->fetch())
{
    header("Location: ./changepwd.php");
}
else
{
    echo 'error';
}

?>