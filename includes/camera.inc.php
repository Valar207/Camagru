<?php
session_start();
require "../config/database_connect.php";
$id = $_SESSION['id'];

// print_r($_FILES);exit;

if(isset($_FILES['file']) && !isset($_POST['camupload']) && !isset($_POST['imgupload']))
{
    $file = $_FILES['file'];
    $filename = $_FILES['file']['name'];
    $filetmpname = $_FILES['file']['tmp_name'];
    $filesize = $_FILES['file']['size'];
    $fileerror = $_FILES['file']['error'];
    $filetype = $_FILES['file']['type'];
    $fileext = explode('.', $filename);
    $fileactualext = strtolower(end($fileext));
    $allowed = array('jpg', 'jpeg', 'png');

    print_r(getimagesize($file));exit;

    if (in_array($fileactualext, $allowed))
    {
        if ($fileerror === 0)
        {
            if ($filesize < 1000000){
                $filenamenew = $_SESSION['id'].".".$fileactualext;
                $filedestination = '../post_img/'.$filenamenew;

                /*increment img_nbr*/
                $req = $bdd->prepare("UPDATE users SET img_nbr = img_nbr+1 WHERE idUsers= :id");
                $req->execute(array('id' => $id));
                $img = '';
                /*insert image dans bdd*/
                $req = $bdd->prepare("INSERT INTO pictures (id_user, img) VALUES (:id, :img)");
                $req->execute(array('id' => $id, 'img' => $img));         

                /* get img id */
                $req = $bdd->prepare("SELECT id_img FROM pictures WHERE img = :img");
                $req->execute(array('img' => $img));
                if ($row = $req->fetch()){
                    $id_img = $row['id_img'];
                }
                $img = './post_img/'.$_SESSION['nameUsers'].'_'.$id_img.'.png';

                $req = $bdd->prepare("UPDATE pictures SET img = :img WHERE id_img = :id_img");
                $req->execute(array('img' => $img, 'id_img' => $id_img));

                move_uploaded_file($filetmpname, '.'.$img);
                header("Location: ../camera.php");
            }
            else{
                echo 'file too big';
            }
        }
        else{
            echo 'error uploading file';
        }
    }
    else{
        header("Location: ../camera.php");
    }
}

if(isset($_POST['camupload']))
{

    if (isset($_POST['sticker_v']))
        $sticker = $_POST['sticker_v'];
    else
        $sticker = '';

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
    
    /*increment img_nbr*/
    $req = $bdd->prepare("UPDATE users SET img_nbr = img_nbr+1 WHERE idUsers= :id");
    $req->execute(array('id' => $id));

    $path_img = '';
    /*insert image dans bdd*/
    $req = $bdd->prepare("INSERT INTO pictures (id_user, img) VALUES (:id, :img)");
    $req->execute(array('id' => $id, 'img' => $path_img));
    
    /* get img id */
    $req = $bdd->prepare("SELECT id_img FROM pictures WHERE img = :img");
    $req->execute(array('img' => $path_img));
    if ($row = $req->fetch()){
        $id_img = $row['id_img'];
    }

    $path_img = './post_img/'.$_SESSION['nameUsers'].'_'.$id_img.'.png';


    $req = $bdd->prepare("UPDATE pictures SET img = :img WHERE id_img = :id_img");
    $req->execute(array('img' => $path_img, 'id_img' => $id_img));

    /*save img dans post_img*/
    imagepng($source_img, '../post_img/'.$_SESSION['nameUsers'].'_'.$id_img.'.png');

    imagedestroy($source_img);



    // add sticker on the saved pic

    $dest = imagecreatefrompng('../post_img/'.$_SESSION['nameUsers'].'_'.$id_img.'.png');
    $src = imagecreatefrompng($sticker);
    imagealphablending($dest, true);
    imagesavealpha($dest, true);

    imagecopy($dest, $src, 0, 0, 0, 0, 480, 480);
    imagepng($dest, '../post_img/'.$_SESSION['nameUsers'].'_'.$id_img.'.png');
    imagedestroy($dest);
    imagedestroy($src);

    header("Location: ../camera.php");
}
else{
    echo 'no';
}



if(isset($_POST['imgupload']))
{

    if (isset($_POST['sticker_v']))
        $sticker = $_POST['sticker_v'];
    else
        $sticker = '';

    $base64 = $_POST['imgupload'];

    list($src, $base64) = explode(';', $base64);
    list($base64, $data) = explode(',', $base64);
    $data = base64_decode($data);
    $source_img = imagecreatefromstring($data);

    /*store img_nbr in SESSION*/
    $req = $bdd->prepare("SELECT * FROM users WHERE idUsers= :id");
    $req->execute(array('id' => $id));
    if ($row = $req->fetch())
        $_SESSION['img_nbr'] = $row['img_nbr'];
    
    /*increment img_nbr*/
    $req = $bdd->prepare("UPDATE users SET img_nbr = img_nbr+1 WHERE idUsers= :id");
    $req->execute(array('id' => $id));

    $path_img = '';
    /*insert image dans bdd*/
    $req = $bdd->prepare("INSERT INTO pictures (id_user, img) VALUES (:id, :img)");
    $req->execute(array('id' => $id, 'img' => $path_img));
    
    /* get img id */
    $req = $bdd->prepare("SELECT id_img FROM pictures WHERE img = :img");
    $req->execute(array('img' => $path_img));
    if ($row = $req->fetch()){
        $id_img = $row['id_img'];
    }

    $path_img = './post_img/'.$_SESSION['nameUsers'].'_'.$id_img.'.png';


    $req = $bdd->prepare("UPDATE pictures SET img = :img WHERE id_img = :id_img");
    $req->execute(array('img' => $path_img, 'id_img' => $id_img));

    /*save img dans post_img*/
    imagepng($source_img, '../post_img/'.$_SESSION['nameUsers'].'_'.$id_img.'.png');

    imagedestroy($source_img);



    // add sticker on the saved pic

    $dest = imagecreatefrompng('../post_img/'.$_SESSION['nameUsers'].'_'.$id_img.'.png');
    $src = imagecreatefrompng($sticker);
    imagealphablending($dest, true);
    imagesavealpha($dest, true);

    imagecopy($dest, $src, 0, 0, 0, 0, 480, 480);
    imagepng($dest, '../post_img/'.$_SESSION['nameUsers'].'_'.$id_img.'.png');
    imagedestroy($dest);
    imagedestroy($src);

    header("Location: ../camera.php");
}
else{
    echo 'no';
}
?>