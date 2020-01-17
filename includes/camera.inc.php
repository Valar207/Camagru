<?php
session_start();
require "../config/database_connect.php";
$id = $_SESSION['id'];

if(isset($_POST['camupload']))
{
    $base64 = $_POST['camupload'];
    list($src, $base64) = explode(';', $base64);
    list($base64, $data) = explode(',', $base64);
    $data = base64_decode($data);
    $source_img = imagecreatefromstring($data);
    imageflip($source_img, IMG_FLIP_HORIZONTAL);

    /*store img_nbr in SESSION*/
    $req = $bdd->prepare("SELECT * FROM users WHERE idUsers= :id");
    $req->execute(array('id' => $id));
    if ($row = $req->fetch())
        $_SESSION['img_nbr'] = $row['img_nbr'];
    $req->closeCursor();
    
    /*increment img_nbr*/
    $req = $bdd->prepare("UPDATE users SET img_nbr = img_nbr+1 WHERE idUsers= :id");
    $req->execute(array('id' => $id));
    $req->closeCursor();

    $path_img = './post_img/'.$_SESSION['nameUsers'].'_'.$_SESSION['img_nbr'].'.png';
    /*insert image dans bdd*/
    $req = $bdd->prepare("INSERT INTO pictures (id_user, img) VALUES (:id, :img)");
    $req->execute(array('id' => $id, 'img' => $path_img));
    $req->closeCursor();
    
    /* get img id */
    $req = $bdd->prepare("SELECT id_img FROM pictures WHERE img = :img");
    $req->execute(array('img' => $path_img));
    if ($row = $req->fetch()){
        $_SESSION['id_img'] = $row['id_img'];
    }
    $req->closeCursor();

    /*save img dans post_img*/
    $imageSave = imagepng($source_img, '../post_img/'.$_SESSION['nameUsers'].'_'.$_SESSION['img_nbr'].'.png');

    imagedestroy($source_img);
    header("Location: ../camera.php");
}
else{
    echo 'no';
}
?>