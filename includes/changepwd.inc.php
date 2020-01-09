<?PHP 
session_start();
require "../config/database_connect.php";
$mail = $_SESSION['mail'];
$pwd = $_POST['pwd1'];
if(empty($_POST['pwd1']) || empty($_POST['pwd2']))
{
    header("Location: ../changepwd.php?error=emptyfield");
    exit();
}
else if($_POST['pwd1'] === $_POST['pwd2'])
{
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    $req = $bdd->prepare("UPDATE users SET pwdUsers = :pwd WHERE emailUsers = :mail");
    $req->execute(array('mail' => $mail, 'pwd' => $hashedPwd));
    $req->closeCursor();
    header("Location: ../index.php?changepwd=success");
    exit();
}
else
{
    header("Location: ../changepwd.php?error=pwd_no_match");
    exit(); 
}


?>