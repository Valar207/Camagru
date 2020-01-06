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
        $sql = "SELECT * FROM users WHERE emailUsers= :mail OR nameUsers= :mail";
        $req = $bdd->prepare($sql);
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