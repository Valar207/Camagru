<?php
require "../header.php";
require "../functions.php";
if (isset($_POST['signup']))
{
    require "../config/database_connect.php";

    $mail = $_POST['mail'];
    $username = $_POST['username'];
    $password = $_POST['pwd'];
    $password2 = $_POST['pwd2'];

    if (empty($username) || empty($mail) || empty($password) || empty($password2))
    {
        header("Location: ../signup.php?error=emptyfields");
        exit();
    }
    else if (!filter_var($mail, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username))
    {
        header("Location: ../signup.php?error=invalidmailuid");
        exit();
    }
    else if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
    {
        header("Location: ../signup.php?error=invalidmail");
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username))
    {
        header("Location: ../signup.php?error=invalidusername");
        exit();
    }
    else if ($password !== $password2)
    {
        header("Location: ../signup.php?error=passwordcheck");
        exit();
    }
    else
    {
        /*CHECK IF NAME TAKEN*/
        $sql = "SELECT nameUsers FROM users WHERE nameUsers= :username";
        $req = $bdd->prepare($sql);
        $req->execute(array('username' => $username));
        if($checkname = $req->fetch()) //check if a line contain the same name
        {
            header("Location: ../signup.php?error=usertaken");
            $req->closeCursor();
            exit();
        }

        /*CHECK IF EMAIL TAKEN*/
        $sql = "SELECT emailUsers FROM users WHERE emailUsers= :mail";
        $req = $bdd->prepare($sql);
        $req->execute(array('mail' => $mail));
        if($checkname = $req->fetch()) //check if a line contain the same email
        {
            header("Location: ../signup.php?error=emailtaken");
            $req->closeCursor();
            exit();
        }
        else
        {
            $cle = md5(microtime(TRUE)*100000); //création clé d'activation
            sendActivation($username, $mail, $cle);
            $sql = "INSERT INTO users (nameUsers, emailUsers, pwdUsers, cle) VALUES (:username, :mail, :pwd, :cle)";
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT); //hash le mdp
            $req = $bdd->prepare($sql);
            $req->execute(array('username' => $username, 'mail' => $mail, 'pwd' => $hashedPwd, 'cle' => $cle));
            $req->closeCursor();
            header("Location: ../index.php?signup=success");
            exit();
        }


    }
}

?>