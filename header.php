<?PHP
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camagru</title>
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
                            <!-- <div class="camagruh col-md-8">
                                <a class="nav-left" href="./galerie.php">Camagru</a>
                            </div>
                            <div class="col-md-4 text-right margin">
                                <a class="nav-right" href="./index.php"><img src="icones/profil.svg" class="profil-ico"></a>
                                <a class="nav-right" href="./galerie.php"><img src="icones/galerie.svg" class="galerie-ico"></a>
                            </div> -->


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
                                        
                                        </li>
                                    </ul>                                   
                                </div>
                            </nav>
                        </div>
                   <?php }
                    else 
                    { ?>
                        
                        <div class="camagruh col-md-6 col-sm-6 col-6">
                            <a href="camera.php"><img src="icones/photo.png" alt="" class="photo-ico"></a>
                            <a class="nav-left" href="./galerie.php">Camagru</a>
                        </div>         
                        
                        <div class="col-md-6 col-sm-6 col-6">
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
                                        <li class="nav-item">
                                            <a class="" href="#"><img src="icones/notification.svg" class="notif-ico"></a>
                                            <ul class="notif">
                                                <li>1</li>
                                            </ul>
                                        </li>
                                    </ul>                                   
                                </div>
                            </nav>
                        </div>
     



                            
                    <?php } ?>
                
    </div>
</div>
</div>