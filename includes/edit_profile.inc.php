<?php
require "../header.php";
require "../config/database_connect.php";

$mail = htmlspecialchars($_POST['mail']);
$username = htmlspecialchars($_POST['username']);
$bio = htmlspecialchars($_POST['bio']);

$ses_username = $_SESSION['nameUsers'];
$ses_mail = $_SESSION['mail'];
$ses_bio = $_SESSION['bio'];


if ($bio == $_SESSION['bio'] && $username == $_SESSION['nameUsers'] && $mail == $_SESSION['mail'])
{
    header("Location: ../edit_profile.php");
    exit();
}
else if ((isset($mail) && $mail !== $ses_mail) 
&& (isset($bio) && $bio !== $ses_bio)
&& (isset($username) && $username !== $ses_username))
{
    $req = $bdd->prepare('UPDATE users SET bio = :bio, emailUsers = :mail, nameUsers = :username WHERE idUsers ="'.$_SESSION['id'].'"');
    $req->execute(array('bio' => $bio, 'mail' => $mail, 'username' => $username));
    $req->closeCursor();
    $_SESSION['bio'] = $bio;
    $_SESSION['mail'] = $mail;
    $_SESSION['nameUsers'] = $username;
    header("Location: ../edit_profile.php?success=usermailbiomodified");
}
else if ((isset($mail) && $mail !== $ses_mail) 
&& (isset($bio) && $bio !== $ses_bio))
{
    $req = $bdd->prepare('UPDATE users SET bio = :bio, emailUsers = :mail WHERE idUsers ="'.$_SESSION['id'].'"');
    $req->execute(array('bio' => $bio, 'mail' => $mail));
    $req->closeCursor();
    $_SESSION['bio'] = $bio;
    $_SESSION['mail'] = $mail;
    header("Location: ../edit_profile.php?success=mailbiomodified");
}
else if ((isset($username) && $username !== $ses_username) 
&& (isset($bio) && $bio !== $ses_bio))
{
    $req = $bdd->prepare('UPDATE users SET bio = :bio, nameUsers = :username WHERE idUsers ="'.$_SESSION['id'].'"');
    $req->execute(array('bio' => $bio, 'username' => $username));
    $req->closeCursor();
    $_SESSION['bio'] = $bio;
    $_SESSION['nameUsers'] = $username;
    header("Location: ../edit_profile.php?success=userbiomodified");
}
else if ((isset($username) && $username !== $ses_username) 
&& (isset($mail) && $mail !== $ses_mail))
{
    $req = $bdd->prepare('UPDATE users SET emailUsers = :mail, nameUsers = :username WHERE idUsers ="'.$_SESSION['id'].'"');
    $req->execute(array('mail' => $mail, 'username' => $username));
    $req->closeCursor();
    $_SESSION['mail'] = $mail;
    $_SESSION['nameUsers'] = $username;
    header("Location: ../edit_profile.php?success=usermailmodified");
}
else if (isset($bio) && $bio !== $_SESSION['bio'])
{    
    if (empty($_SESSION['bio']))
    {
        $req = $bdd->prepare("UPDATE users SET bio = :bio");
        $req->execute(array('bio' => $bio));
        $req->closeCursor();
    }
    else
    {
        $req = $bdd->prepare('UPDATE users SET bio = :bio WHERE idUsers ="'.$_SESSION['id'].'"');
        $req->execute(array('bio' => $bio));
        $req->closeCursor();
    }
    $_SESSION['bio'] = $bio;
    header("Location: ../edit_profile.php?success=biomodified");
}
else if (isset($mail) && $mail !== $ses_mail)
{
    $req = $bdd->prepare('UPDATE users SET emailUsers = :mail WHERE idUsers ="'.$_SESSION['id'].'"');
    $req->execute(array('mail' => $mail));
    $req->closeCursor();

    $_SESSION['mail'] = $mail;
    header("Location: ../edit_profile.php?success=mailmodified");
}
else if (isset($username) && $username !== $ses_username)
{
    $req = $bdd->prepare('UPDATE users SET nameUsers = :username WHERE idUsers ="'.$_SESSION['id'].'"');
    $req->execute(array('username' => $username));
    $req->closeCursor();
    $_SESSION['nameUsers'] = $username;
    header("Location: ../edit_profile.php?success=usermodified");
}

?>