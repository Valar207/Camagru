<?php
session_start();
require "../config/database_connect.php";

$id_user = $_SESSION['id'];
$id_img = $_POST['id_img'];
$com = $_POST['com'];
$page = $_POST['page'];

// $id_img_com = $_POST['id_img'];


if (isset($com)){
    $req = $bdd->prepare("INSERT INTO comments (id_user, id_img, comment) VALUES (:iduser, :id_img, :com)");
    if ($req->execute(array('iduser' => $id_user, 'id_img' => $id_img, 'com' => $com))){
        header("Location: ../photo.php?id_img=$id_img&page=$page");
    }
    $req->closeCursor();
}



?>
