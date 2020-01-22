<?php
session_start();
require "../config/database_connect.php";

$delimg = $_POST['delimg'];
$pagecourante = $_POST['pagecourante'];
$id_user = $_SESSION['id'];


$req = $bdd->prepare("SELECT id_img FROM pictures WHERE img = :delimg");
$req->execute(array('delimg' => $delimg));
if ($row = $req->fetch())
    $id_img = $row['id_img'];


if (isset($_POST['delimg'])){

    $req = $bdd->prepare("DELETE comments FROM comments INNER JOIN pictures ON pictures.id_img = comments.id_img
    WHERE comments.id_img = :id_img");
    if ($req->execute(array('id_img' => $id_img))){

        $req = $bdd->prepare("DELETE `likes` FROM `likes` INNER JOIN pictures ON pictures.id_img = likes.id_img WHERE likes.id_img = :id_img");
        $req->execute(array('id_img' => $id_img));

        $req = $bdd->prepare("DELETE FROM pictures WHERE img= :delimg");
        if ($req->execute(array('delimg' => $delimg)))
        {
            unlink('.'.$delimg);
            $req = $bdd->prepare("UPDATE users SET img_nbr = img_nbr - 1 WHERE idUsers=:id_user");
            if ($req->execute(array('id_user' => $id_user)))
                header("Location: ../profile.php?picture=deleted&page=$pagecourante");
            else
                echo 'error';

            
        }
        else
            header("Location: ../profile.php?picture=error");
    }
}
else{
    echo 'error';
    exit;
}



?>