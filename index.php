<?php
    session_start();
    require "header.php";
    require "./config/database_connect.php";

    if (isset($_GET['signup']))
    {
        if ($_GET['signup'] == 'success')
            echo 'Inscription finie, votre lien d\'activation vous a été envoyé, cliquez sur ce lien';
    }
    else if (isset($_GET['actif']))
    {
        if ($_GET['actif'] == 'success')
            echo "Votre compte a bien été activé !";
        else if ($_GET['actif'] == 'already')
            echo "Votre compte est déjà actif !";
        else if ($_GET['actif'] == 'error')
            echo "Erreur ! Votre compte ne peut être activé...";
    }
    else if (isset($_GET['error']))
    {
        if ($_GET['error'] == 'emptyfields')
            echo '<div class="alert alert-danger" role="alert">
            Remplissez tous les champs!
          </div>';
        if ($_GET['error'] == 'wrongpwd')
            echo "Mauvais mot de passe";
        if ($_GET['error'] == 'noactif')
            echo "Votre compte n'est pas encore actif";
        if ($_GET['error'] == 'nouser')
            echo "Cet utilisateur n'existe pas";
    }
    else if (isset($_GET['profile']))
    {
        if ($_GET['profile'] == 'logout')
            echo 'Vous êtes déconnecté';
    }
    if (isset($_SESSION['nameUsers']))
    {
        echo "Vous êtes connecté";
        echo '
            <form action="includes/logout.inc.php" method="post">
                <button class="btn" type="submit" name="logout">Déconnexion</button>
            </form>';
    }
    else if (!isset($_SESSION['nameUsers']))
    {
        echo '
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="mail" placeholder="Username/e-mail">
            <input type="password" name="password" placeholder="Password">
            <button class="btn" type="submit" name="connexion">Connexion</button>
        </form>
        <br>
        <a href="./reset.php">Mot de passe oublié ?</a>
        <p>Pas de compte ? <a href="signup.php">Inscrivez-vous</a></p>';
    }



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
            Mauvais mot de passe
            </div>';
            if ($_GET['error'] == 'noactif')
            echo '<div class="alert alert-danger" role="alert">
            Votre compte n\'est pas encore actif
            </div>';
            if ($_GET['error'] == 'nouser')
            echo '<div class="alert alert-danger" role="alert">
            Cet utilisateur n\'existe pas
            </div>';
        }
    ?>
    <div class="form-group">
        <input style="margin-bottom:5px;" type="text" name="mail" placeholder="Username/e-mail" id="username" class="form-control">
        <input type="password" name="password" placeholder="Password" id="password" class="form-control">
    </div>
        <button class="btn btn-primary btn-block" type="submit" name="connexion">Connexion</button>
    <p class="hr">OU</p>
    </form>
    <a href="./reset.php"><p class="pwd-forgot">Mot de passe oublié ?</p></a>
</div>
<div class="container no-account">
Pas de compte ? <a href="signup.php"> Inscrivez-vous</a>
</div>











