<?PHP
session_start();
require "config/database_connect.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camagru</title>
    <link rel="shortcut icon" href="icones/photo.png" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css?<?php echo time(); ?>">
    <script type="text/javascript" src="js/script.js?<?php echo time(); ?>"></script>
</head>
<div class="container-fluid whiteheader">
<div class="container header">
        <div class="row size">

                <?php
                    if (!isset($_SESSION['nameUsers']))
                    {
                        ?>
                            <div class="camagruh col-md-6 col-sm-6 col-6">
                            <a class="nav-left" href="./galerie.php">Camagru</a>
                        </div>         
                        
                        <div class="col-md-6 col-sm-6 col-6">
                               <nav class="navbar-expand-lg navbar-expand-sm navbar-expand-xs navbar-light ">
                                <div class="">
                                    <ul class="nav navbar-nav nv-right">
                                       
                                        <li class="nav-item">
                                            <a class="" href="./index.php"><img src="icones/profil.svg" class="profil-ico"></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="" href="./galerie.php"><img src="icones/galerie.svg" class="galerie-ico"></a>
                                        </li>
                                        
                                    </ul>                                   
                                </div>
                            </nav>
                        </div>
                   <?php }
                    else 
                    { 
                            /*count com*/
                            $req = $bdd->prepare("SELECT * FROM comments 
                            INNER JOIN users ON comments.id_user = users.idUsers 
                            INNER JOIN pictures ON comments.id_img = pictures.id_img WHERE
                            pictures.id_user = :id_user AND idUsers != :id_user AND comments.active = 1");
                            $req->execute(array('id_user' => $_SESSION['id']));
                            $act_com = $req->rowCount();

                            /*count likes*/
                            $req = $bdd->prepare("SELECT * FROM likes 
                            INNER JOIN users ON likes.id_user = users.idUsers 
                            INNER JOIN pictures ON likes.id_img = pictures.id_img WHERE
                            pictures.id_user = :id_user AND idUsers != :id_user AND likes.active = 1");
                            $req->execute(array('id_user' => $_SESSION['id']));
                            $act_like = $req->rowCount(); 
                            ?>
                        
                        <div class="camagruh col-md-6 col-sm-6 col-3">
                            <a class="nav-left" href="./galerie.php">Camagru</a>
                            <a href="camera.php"><img src="icones/photo.png" alt="" class="photo-ico"></a>
                        </div>         
                        
                        <div class="col-md-6 col-sm-6 col-9">
                               <nav class="navbar-expand-lg navbar-expand-sm navbar-expand-xs navbar-light ">
                                <div class="">
                                    <ul class="nav navbar-nav nv-right">
                                        <li class="nav-item">
                                            <a class="" href="./includes/logout.inc.php?logout=ok"><img src="icones/logout.svg" class="logout-ico"></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="" href="./profile.php"><img src="icones/profil.svg" class="profil-ico"></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="" href="./galerie.php"><img src="icones/galerie.svg" class="galerie-ico"></a>
                                        </li>
                                        <li class="nav-item notif-on">

                                        <?php
                                            // $req = $bdd->prepare("SELECT * FROM likes WHERE id_user != :id AND active = 1");
                                            // $req->execute(array('id' => $_SESSION['id']));
                                            // $nb_likes = $req->rowCount();
                                            // $req = $bdd->prepare("SELECT * FROM comments WHERE id_user != :id AND active = 1");
                                            // $req->execute(array('id' => $_SESSION['id']));
                                            // $nb_com = $req->rowCount();
                                            // $nb_notif = $nb_com + $nb_likes;

                                            $sum_notif = $act_com+$act_like;
                                            if ($sum_notif > 0){
                                                echo '<span class="pop-notif text-center">'.$sum_notif.'</span>';
                                            }
                                        ?>
                                        
                                            

                                            <a class="" href="#"><img src="icones/notification.svg" class="notif-ico"></a>

                                            <?php
                                            if ($act_like > 0 || $act_com > 0)
                                               echo '<ul class="notifs">';
                                     

                                            /* notifs */
                                                $req = $bdd->prepare("SELECT * FROM comments 
                                                INNER JOIN users ON comments.id_user = users.idUsers 
                                                INNER JOIN pictures ON comments.id_img = pictures.id_img WHERE
                                                pictures.id_user = :id_user AND idUsers != :id_user AND comments.active = 1");
                                                $req->execute(array('id_user' => $_SESSION['id']));
                                                /*notif commentaires*/
                                                    while($row = $req->fetch()){
                                                        $username = $row['nameUsers'];
                                                        $id_img = $row['id_img'];
                                                        echo '<li class="item notif"><a href="photo.php?id_img='.$id_img.'&page=1&a=0">'.$username.' a commenté votre photo</a></li>';
                                                     }

                                                    $req = $bdd->prepare("SELECT * FROM likes 
                                                    INNER JOIN users ON likes.id_user = users.idUsers 
                                                    INNER JOIN pictures ON likes.id_img = pictures.id_img WHERE
                                                    pictures.id_user = :id_user AND idUsers != :id_user AND likes.active = 1");
                                                    $req->execute(array('id_user' => $_SESSION['id']));
                                                /*notif likes*/
                                                    while($row = $req->fetch()){
                                                        $username = $row['nameUsers'];
                                                        $id_img = $row['id_img'];
                                                        ?>
                                                        <li class="item notif"><a href="photo.php?id_img= <?php echo $id_img ?> &page=1&a=0"> <?php echo $username ?> a aimé votre photo</a></li>
                                                    <?php } ?>

                                                    <?php if ($req->rowCount() > 0)
                                                        ?> 
                                                    </ul> <?php ; 
                                            ?>
                                        </li>
                                    </ul>                                   
                                </div>
                            </nav>
                        </div>
                    <?php } 
                    ?>
    </div>
</div>
</div>