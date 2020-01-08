<?php
require "../header.php";
require "../config/database_connect.php";

$mail = $_POST['mail'];
$username = $_POST['username'];
$bio = $_POST['bio'];

if (isset($_POST['mail']))
{
    $sql = "UPDATE users SET emailUsers = :mail WHERE emailUsers ='".$_SESSION['mail']."'";
    $req = $bdd->prepare($sql);
    $req->execute(array('mail' => $mail));
    $req->closeCursor();

    $_SESSION['mail'] = $mail;
    header("Location: ../profile.php");
}
if (isset($_POST['username']))
{
    $sql = "UPDATE users SET nameUsers = :username WHERE nameUsers ='".$_SESSION['nameUsers']."'";
    $req = $bdd->prepare($sql);
    $req->execute(array('username' => $username));
    $req->closeCursor();

    $_SESSION['nameUsers'] = $username;
    header("Location: ../profile.php");
}
if (isset($bio))
{    
    if (empty($_SESSION['bio']))
    {
        $sql = "UPDATE users SET bio = :bio";
        $req = $bdd->prepare($sql);
        $req->execute(array('bio' => $bio));
        $req->closeCursor();
    }
    else
    {
        $sql = "UPDATE users SET bio = :bio WHERE nameUsers='".$_SESSION['nameUsers']."'";
        $req = $bdd->prepare($sql);
        $req->execute(array('bio' => $bio));
        $req->closeCursor();
    }
    $_SESSION['bio'] = $bio;
    header("Location: ../profile.php");
}

?>