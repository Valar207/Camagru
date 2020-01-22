<?php
session_start();
require "../config/database_connect.php";


if (isset($_POST['com'])){
    $com = $_POST['com'];
    $id_user = $_SESSION['id'];
    $id_img = $_POST['id_img'];
    $page = $_POST['page'];

    $req = $bdd->prepare("INSERT INTO comments (id_user, id_img, comment) VALUES (:iduser, :id_img, :com)");
    if ($req->execute(array('iduser' => $id_user, 'id_img' => $id_img, 'com' => $com))){
        header("Location: ../photo.php?id_img=$id_img&page=$page");
    }
}
else if (isset($_POST['like'])){

    $id_user = $_SESSION['id'];
    $id_img = $_POST['id_img'];
    $page = $_POST['page'];

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

            header("Location: ../photo.php?id_img=$id_img&page=$page");
            }
        }
    }



?>
