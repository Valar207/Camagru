<?php
session_start();
require "../config/database_connect.php";
$id = $_SESSION['id'];

if (isset($_FILES['file']))
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

    if (in_array($fileactualext, $allowed))
    {
        if ($fileerror === 0)
        {
            if ($filesize < 1000000){
                $filenamenew = $_SESSION['id'].".".$fileactualext;
                $filedestination = '../profile_pics/'.$filenamenew;
                if ($_SESSION['img_p'] !== './profile_pics/default_profile.jpg')
                    unlink('.'.$_SESSION['img_p']);
                move_uploaded_file($filetmpname, $filedestination);
                $_SESSION['img_p'] = './profile_pics/'.$filenamenew;
                $req = $bdd->prepare("UPDATE users SET img= :img WHERE idUsers= :id");
                $req->execute(array('id' => $id, 'img' => $_SESSION['img_p']));
                $req->closeCursor();
                header("Location: ../edit_profile.php?upload=success");
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
        header("Location: ../edit_profile.php?upload=fail");
    }
}

?>