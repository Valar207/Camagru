<?php
session_start();
require "../config/database_connect.php";

$id_user = $_SESSION['id'];
$id_img = $_POST['valimg'];
$com = $_POST['com'];

if (isset($com)){
    $req = $bdd->prepare("INSERT INTO comments (id_user, id_img, comment) VALUES (:iduser, :id_img, :com)");
    if ($req->execute(array('iduser' => $id_user, 'id_img' => $id_img, 'com' => $com))){
        header("Location: ../galerie.php?comment=success");
    }
    $req->closeCursor();
}



?>
