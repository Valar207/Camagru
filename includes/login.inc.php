<?php

if (isset($_POST['connexion']))
{
    require "../config/database_connect.php";

    $mail = $_POST['mail'];
    $password = $_POST['password'];

    if (empty($mail) || empty($password))
    {
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
    else
    {
        $req = $bdd->prepare("SELECT * FROM users WHERE emailUsers= :mail OR nameUsers= :mail");
        $req->execute(array('mail' => $mail));
        if ($row = $req->fetch())
        {
            $pwdCheck = password_verify($password, $row['pwdUsers']);
            $actif = $row['actif'];
            if ($pwdCheck == false)
            {
                header("Location: ../index.php?error=wrongpwd");
                exit();
            }
            else if ($actif == 0)
            {
                header("Location: ../index.php?error=noactif");
                exit();
            }
            else if ($pwdCheck == true)
            {
                session_start();
                $_SESSION['nameUsers'] = $row['nameUsers'];
                $_SESSION['mail'] = $row['emailUsers'];
                $_SESSION['id'] = $row['idUsers'];
                $_SESSION['img_p'] = $row['img'];
                header("Location: ../index.php?login=success");
                exit();
            }
        }
        else
        {
            header("Location: ../index.php?error=nouser");
            exit();
        }
    }
}


?>