<?php
session_start();
require "../config/database_connect.php";

$pwd = htmlspecialchars($_POST['pwd']);
$id = $_SESSION['id'];

if (empty($pwd))
{
    header("Location: ../profile_delaccount.php?error=emptyfields");
    exit();
}
else
{
    $req = $bdd->prepare("SELECT * FROM users WHERE idUsers= :id");
    $req->execute(array('id' => $id));
    if ($row = $req->fetch())
    {
        $pwdCheck = password_verify($pwd, $row['pwdUsers']);
        $req->closeCursor();
        if ($pwdCheck == false)
        {
            header("Location: ../profile_delaccount.php?error=wrongpwd");
            exit();
        }
        else if ($pwdCheck == true)
        {
            $req = $bdd->prepare("DELETE FROM pictures WHERE id_user= :id");
            $req->execute(array('id' => $id));
            $req = $bdd->prepare("DELETE FROM likes WHERE id_user= :id");
            $req->execute(array('id' => $id));
            $req = $bdd->prepare("DELETE FROM comments WHERE id_user= :id");
            $req->execute(array('id' => $id));
            $req = $bdd->prepare("DELETE FROM users WHERE idUsers= :id");
            $req->execute(array('id' => $id));
            $req->closeCursor();
            session_start();
            session_unset();
            session_destroy();
            header("Location: ../index.php?success=account_deleted");
            exit();
        }
    }
}

?>