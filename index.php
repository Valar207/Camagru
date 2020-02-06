<?php
    require "header.php";

    if (isset($_SESSION['nameUsers']))
    {
        header("Location: galerie.php");
        exit;
    }

    //require "./config/database_connect.php";
?>

<div class="login-form">
    <h1 class="camagru">Camagru</h1>
    <form action="includes/login.inc.php" method="post">

    <?PHP

        if (isset($_GET['signup']))
        {
            if ($_GET['signup'] == 'success')
            echo '<div class="alert alert-success" role="alert">
                Inscription finie, votre lien d\'activation vous a été envoyé, cliquez sur ce lien
            </div>';
        }
        else if (isset($_GET['actif']))
        {
            if ($_GET['actif'] == 'success')
                echo '<div class="alert alert-success" role="alert">
                    Votre compte a bien été activé !
                    </div>';
            else if ($_GET['actif'] == 'already')
                echo '<div class="alert alert-secondary" role="alert">
                    Votre compte est déjà actif !
                    </div>';
            else if ($_GET['actif'] == 'error')
                echo '<div class="alert alert-danger" role="alert">
                    Erreur ! Votre compte ne peut être activé...
                    </div>';
        }
        if (isset($_GET['error']))
        {
            if ($_GET['error'] == 'emptyfields')
                echo '<div class="alert alert-danger" role="alert">
                Remplissez tous les champs!
            </div>';
            if ($_GET['error'] == 'wrongpwd')
            echo '<div class="alert alert-danger" role="alert">
            Mauvais email ou mot de passe
            </div>';
            if ($_GET['error'] == 'noactif')
            echo '<div class="alert alert-danger" role="alert">
            Votre compte n\'est pas encore actif
            </div>';
            if ($_GET['error'] == 'nouser')
            echo '<div class="alert alert-danger" role="alert">
            Mauvais email ou mot de passe
            </div>';
        }
        if (isset($_GET['changepwd']))
        {
            if ($_GET['changepwd'] == 'success')
                echo '<div class="alert alert-success" role="alert">
                Votre mot de passe a bien été modifié
                </div>';
        }
        if (isset($_GET['success']))
        {
            if ($_GET['success'] == 'account_deleted')
            echo '<div class="alert alert-success" role="alert">
            Votre compte a bien été supprimé !
            </div>';
        }
    ?>
    <div class="form-group">
        <input style="margin-bottom:5px;" type="text" name="mail" placeholder="E-mail ou nom d'utilisateur" id="username" class="form-control">
        <input type="password" name="password" placeholder="Mot de passe" id="password" class="form-control">
    </div>
        <button class="btn btn-primary btn-block" type="submit" name="connexion">Connexion</button>
    <p class="hr">OU</p>
    </form>
    <a class="pwd-forgot" href="./forgotten_pwd.php"><p class="pwd-forgot">Mot de passe oublié ?</p></a>
</div>
<div class="container no-account">
Pas de compte ? <a href="inscription.php"> Inscrivez-vous</a>
</div>

<footer class="whitefooter text-center">
	Camagru 2020 @vrossi
</footer>









