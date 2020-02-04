<?php
session_start();
require "../config/database_connect.php";
$id = $_SESSION['id'];


if(isset($_POST['delstick']))
{
    $sticker = $_POST['sticker'];
    $req = $bdd->prepare("DELETE FROM stickers WHERE sticker= :sticker");
    $req->execute(array('sticker' => $sticker));
    header("Location: ../camera.php");
}



if(isset($_FILES['file2']))
{
    $file = $_FILES['file2'];
    $filename = $_FILES['file2']['name'];
    $filetmpname = $_FILES['file2']['tmp_name'];
    $filesize = $_FILES['file2']['size'];
    $fileerror = $_FILES['file2']['error'];
    $filetype = $_FILES['file2']['type'];
    $fileext = explode('.', $filename);
    $fileactualext = strtolower(end($fileext));
    $allowed = array('png');

    if (in_array($fileactualext, $allowed))
    {
        if ($fileerror === 0)
        {
            if ($filesize < 1000000){
                $filenamenew = $_SESSION['id'].".".$fileactualext;
                $filedestination = '../stickers/';
                $path = './stickers/'.$filename;
                
                /*check if sticker exists*/
                $req = $bdd->prepare("SELECT * FROM stickers WHERE sticker=:sticker");
                $req->execute(array('sticker' => $path));
                if($row = $req->fetch()){
                    header("Location: ../camera.php?error=stickerexists");
                    exit;
                }
                else{
                    /*insert sticker dans bdd*/


                    $req = $bdd->prepare("INSERT INTO stickers (sticker) VALUES (:sticker)");
                    $req->execute(array('sticker' => $path)); 


                    // echo $filetmpname;
                    // echo '<br>';
                    // echo $path;exit;
                    move_uploaded_file($filetmpname, '.'.$path);
                    header("Location: ../camera.php");
                }

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
        header("Location: ../camera.php?error=format");
    }
}

?>