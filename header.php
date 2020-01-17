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
    <link rel="stylesheet" href="css/style.css?version=65">
    <script type="text/javascript" src="js/script.js?version=73"></script>
</head>
<div class="container-fluid whiteheader">
<div class="container header">
        <div class="row size">

                <?php
                    if (!isset($_SESSION['nameUsers']))
                    {
                        ?>
                            <div class="camagruh col-md-8">
                                <a class="nav-left" href="./galerie.php">Camagru</a>
                            </div>
                            <div class="col-md-4 text-right margin">
                                <a class="nav-right" href="./index.php"><img src="icones/profil.svg" class="profil-ico"></a>
                                <a class="nav-right" href="./galerie.php"><img src="icones/galerie.svg" class="galerie-ico"></a>
                            </div>
                   <?php }
                    else 
                    { ?>
                        
                        <div class="camagruh col-md-4">
                        <a class="nav-left" href="./galerie.php">Camagru</a>
                        </div>         
                        <div class="col-md-4 margin photo text-center">
                            <a href="camera.php"><img src="icones/photo.png" alt="" class="photo-ico"></a>
                        </div>
                        <div class="col-md-4 text-right margin">
                            <a class="nav-right" href="./profile.php"><img src="icones/profil.svg" class="profil-ico"></a>
                            <a class="nav-right" href="./galerie.php"><img src="icones/galerie.svg" class="galerie-ico"></a>
                            <a class="nav-right" href="./includes/logout.inc.php?logout=ok"><img src="icones/logout.svg" class="logout-ico"></a>
                            </div>
                    <?php } ?>
                
    </div>
</div>
</div>