<?PHP
session_start();
require "../config/database_connect.php";

$_SESSION['mail'] = $_GET['username'];
$mail = $_SESSION['mail'];
$token = $_GET['cle'];

$req = $bdd->prepare("SELECT * FROM users WHERE emailUsers= :mail AND cle = :token");
$req->execute(array('mail' => $mail, 'token' => $token));

if($req->fetch())
{
    header("Location: ../changepwd.php");
}
else
{
    echo 'error';
}

?>