<?php
require "../header.php";
require "./mail_functions.inc.php";
if (isset($_POST['signup']))
{
    require "../config/database_connect.php";

    $mail = $_POST['mail'];
    $username = $_POST['username'];
    $password = $_POST['pwd'];
    $password2 = $_POST['pwd2'];

    if (empty($username) || empty($mail) || empty($password) || empty($password2))
    {
        header("Location: ../inscription.php?error=emptyfields");
        exit();
    }
    else if (!filter_var($mail, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username))
    {
        header("Location: ../inscription.php?error=invalidmailuid");
        exit();
    }
    else if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
    {
        header("Location: ../inscription.php?error=invalidmail");
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username))
    {
        header("Location: ../inscription.php?error=invalidusername");
        exit();
    }
    else if ($password !== $password2)
    {
        header("Location: ../inscription.php?error=passwordcheck");
        exit();
    }
    else
    {
        /*CHECK IF NAME TAKEN*/
        $req = $bdd->prepare("SELECT nameUsers FROM users WHERE nameUsers= :username");
        $req->execute(array('username' => $username));
        if($checkname = $req->fetch()) //check if a line contain the same name
        {
            header("Location: ../inscription.php?error=usertaken");
            $req->closeCursor();
            exit();
        }

        /*CHECK IF EMAIL TAKEN*/
        $req = $bdd->prepare("SELECT emailUsers FROM users WHERE emailUsers= :mail");
        $req->execute(array('mail' => $mail));
        if($checkname = $req->fetch()) //check if a line contain the same email
        {
            header("Location: ../inscription.php?error=emailtaken");
            $req->closeCursor();
            exit();
        }
        else
        {
            $cle = md5(microtime(TRUE)*100000); //création clé d'activation
            sendActivation($username, $mail, $cle);
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT); //hash le mdp
            $req = $bdd->prepare("INSERT INTO users (nameUsers, emailUsers, pwdUsers, cle) VALUES (:username, :mail, :pwd, :cle)");
            $req->execute(array('username' => $username, 'mail' => $mail, 'pwd' => $hashedPwd, 'cle' => $cle));
            $req->closeCursor();
            header("Location: ../index.php?signup=success");
            exit();
        }


    }
}

?>