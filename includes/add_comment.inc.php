<?php
session_start();
require "../config/database_connect.php";
require "./mail_functions.inc.php";



if (isset($_POST['com'])){
    $com = $_POST['com'];
    $id_user = $_SESSION['id'];
    $id_img = $_POST['id_img'];
    $page = $_POST['page'];
    $sender = $_SESSION['nameUsers'];

    $req = $bdd->prepare("INSERT INTO comments (id_user, id_img, comment) VALUES (:iduser, :id_img, :com)");
    if ($req->execute(array('iduser' => $id_user, 'id_img' => $id_img, 'com' => $com))){
        $req = $bdd->prepare("UPDATE pictures SET comment = comment + 1 WHERE id_img = :id_img");
        $req->execute(array('id_img' => $id_img));

        /*to get the mail of the one who got comment*/
        $req = $bdd->prepare("SELECT emailUsers FROM users INNER JOIN pictures ON users.idUsers = pictures.id_user WHERE id_img = :id_img");
        if ($req->execute(array('id_img' => $id_img))){
            if($row = $req->fetch()){
                $mail = $row['emailUsers'];
            }

            /* check if destinataire wants the mail or not */
            $req = $bdd->prepare("SELECT notif_com FROM users WHERE emailUsers = :mail");
            $req->execute(array('mail' => $mail));
            if($req->fetch()['notif_com'] == 1){
                sendComNotif($mail, $sender, $id_img);
            }
        }
        header("Location: ../photo.php?id_img=$id_img&page=$page");
    }
}
else if (isset($_POST['like'])){

    $id_user = $_SESSION['id'];
    $id_img = $_POST['id_img'];
    $page = $_POST['page'];
    $sender = $_SESSION['nameUsers'];

    $req = $bdd->prepare("SELECT * FROM `likes` WHERE id_user = :id_user AND id_img = :id_img");
    if ($req->execute(array('id_user' => $id_user, 'id_img' => $id_img))){
        if ($row = $req->rowCount() == 1){

            $req = $bdd->prepare("DELETE FROM `likes` WHERE id_img = :id_img AND id_user = :id_user");
            $req->execute(array('id_img' => $id_img, 'id_user' => $id_user));

            $req = $bdd->prepare("UPDATE pictures SET `like` = `like` - 1 WHERE id_img = :id_img"); 
            $req->execute(array('id_img' => $id_img));

            header("Location: ../photo.php?id_img=$id_img&page=$page");
        }
        else{
            $req = $bdd->prepare("INSERT INTO likes (id_user, id_img) VALUES (:id_user, :id_img)");
            $req->execute(array('id_user' => $id_user, 'id_img' => $id_img));

            $req = $bdd->prepare("UPDATE pictures SET `like` = `like` + 1 WHERE id_img = :id_img");
            $req->execute(array('id_img' => $id_img));


            /*to get the mail of the one who got liked*/
            $req = $bdd->prepare("SELECT emailUsers FROM users INNER JOIN pictures ON users.idUsers = pictures.id_user WHERE id_img = :id_img");
            if ($req->execute(array('id_img' => $id_img))){
            if($row = $req->fetch()){
                $mail = $row['emailUsers'];
            }
            $req = $bdd->prepare("SELECT notif_like FROM users WHERE emailUsers = :mail");
            $req->execute(array('mail' => $mail));
            if($req->fetch()['notif_like'] == 1){
                sendLikeNotif($mail, $sender, $id_img);
            }
        }
            header("Location: ../photo.php?id_img=$id_img&page=$page");
            }
        }

    }

?>
