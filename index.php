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
            echo "Remplissez tous les champs";
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





