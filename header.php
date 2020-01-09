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
    <link rel="stylesheet" href="css/style.css?version=36">
</head>
<body>
<div class="container-fluid whiteheader">
        <div class="row">
            <div class="camagruh col-md-6">
                Camagru
            </div>
            <div class="col-md-6 text-right test">
                <?php
                    if (!isset($_SESSION['nameUsers']))
                    {
                        echo '<a class="nav-right" href="./inscription.php">Inscription</a>
                            <a class="nav-right" href="./index.php">Connexion</a>
                            <a class="nav-right" href="">Galerie</a>';
                    }
                    else
                        echo '<a class="nav-right" href="./edit_profile.php">Profil</a>
                            <a class="nav-right" href="">Galerie</a>
                            <a class="nav-right" href="./includes/logout.inc.php?logout=ok">Déconnexion</a>';
                ?>
            </div>
    </div>
</div>