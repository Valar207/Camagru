<?php
session_start();
require "../config/database_connect.php";

$id_user = $_SESSION['id'];



if(isset($_POST['notif_com'])){
    $req = $bdd->prepare("UPDATE users SET notif_com = 1 WHERE idUsers=:id_user");
    $req->execute(array('id_user' => $id_user));
    
    header("Location: ../notification.php?com=1");
}
else if(!isset($_POST['notif_com'])){
    $req = $bdd->prepare("UPDATE users SET notif_com = 0 WHERE idUsers=:id_user");
    $req->execute(array('id_user' => $id_user));
    
    header("Location: ../notification.php?com=0");
}
if(isset($_POST['notif_like'])){
    $req = $bdd->prepare("UPDATE users SET notif_like = 1 WHERE idUsers=:id_user");
    $req->execute(array('id_user' => $id_user));
    
    header("Location: ../notification.php?like=1");
}
else if(!isset($_POST['notif_like'])){
    $req = $bdd->prepare("UPDATE users SET notif_like = 0 WHERE idUsers=:id_user");
    $req->execute(array('id_user' => $id_user));
    
    header("Location: ../notification.php?like=0");
}



    // if(isset($_POST['notif_com']) && isset($_POST['notif_like'])){
    //     $req = $bdd->prepare("UPDATE users SET notif_com = 1, notif_like = 1 WHERE idUsers=:id_user");
    //     $req->execute(array('id_user' => $id_user));
    
    //     header("Location: ../notification.php?com=1&like=1");
    // }
    // else if(isset($_POST['notif_com'])){
    //     $req = $bdd->prepare("UPDATE users SET notif_com = 1, notif_like = 0 WHERE idUsers=:id_user");
    //     $req->execute(array('id_user' => $id_user));
    
    //     header("Location: ../notification.php?com=1");
    // }
    // else if(isset($_POST['notif_like'])){
    //     $req = $bdd->prepare("UPDATE users SET notif_like = 1, notif_com = 0 WHERE idUsers=:id_user");
    //     $req->execute(array('id_user' => $id_user));
    
    //     header("Location: ../notification.php?like=1");
    // }
    // else if(!isset($_POST['notif_com']) && !isset($_POST['notif_like'])){
    //     $req = $bdd->prepare("UPDATE users SET notif_com = 0, notif_like = 0 WHERE idUsers=:id_user");
    //     $req->execute(array('id_user' => $id_user));
    
    //     header("Location: ../notification.php?com=0&like=0");
    // }
    // else if(!isset($_POST['notif_com'])){
    //     $req = $bdd->prepare("UPDATE users SET notif_com = 0, notif_like = 1 WHERE idUsers=:id_user");
    //     $req->execute(array('id_user' => $id_user));
    
    //     header("Location: ../notification.php?com=0");
    // }
    // else if(!isset($_POST['notif_like'])){
    //     $req = $bdd->prepare("UPDATE users SET notif_like = 0, notif_com = 1 WHERE idUsers=:id_user");
    //     $req->execute(array('id_user' => $id_user));
    
    //     header("Location: ../notification.php?like=0");
    // }








?>