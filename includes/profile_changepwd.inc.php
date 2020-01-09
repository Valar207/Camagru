<?php
require "../header.php";
require "../config/database_connect.php";

$oldpwd = htmlspecialchars($_POST['oldpwd']);
$newpwd = htmlspecialchars($_POST['newpwd']);
$newpwd2 = htmlspecialchars($_POST['newpwd2']);
$id = $_SESSION['id'];


if (empty($oldpwd) || empty($newpwd) || empty($newpwd2))
{
    header("Location: ../profile_changepwd.php?error=emptyfields");
    exit();
}
else
{
    $req = $bdd->prepare("SELECT * FROM users WHERE idUsers= :id");
    $req->execute(array('id' => $id));
    if ($row = $req->fetch())
    {
        $pwdCheck = password_verify($oldpwd, $row['pwdUsers']);
        $req->closeCursor();
        if ($pwdCheck == false)
        {
            header("Location: ../profile_changepwd.php?error=wrongpwd");
            exit();
        }
        else if ($pwdCheck == true)
        {
            if ($newpwd !== $newpwd2)
            {
                header("Location: ../profile_changepwd.php?error=pwdnomatch");
                exit();
            }
            else
            {
                $hashedpwd = password_hash($newpwd, PASSWORD_DEFAULT); //hash le mdp
                $req = $bdd->prepare("UPDATE users SET pwdUsers = :hashedpwd WHERE idUsers= :id");
                $req->execute(array('id' => $id, 'hashedpwd' => $hashedpwd));
                $req->closeCursor();
                header("Location: ../profile_changepwd.php?success=pwdchanged");
                exit();
            }
        }
    }
}

?>