
<?php
require "header.php";

?>

<div class="login-form">
    <h1 class="camagru">Camagru</h1>
    <form action="includes/signup.inc.php" method="post">

<?PHP

if (isset($_GET['error']))
{
    if ($_GET['error'] == 'emptyfields')
    echo '<div class="alert alert-danger" role="alert">
    Remplissez tous les champs
    </div>';
    else if ($_GET['error'] == "invalidmailusername")
        echo '<div class="alert alert-danger" role="alert">
        Email et pseudo invalides
        </div>';
    else if ($_GET['error'] == "invalidmail")
        echo '<div class="alert alert-danger" role="alert">
        Email invalide
        </div>';
    else if ($_GET['error'] == "invalidusername")
        echo '<div class="alert alert-danger" role="alert">
        Pseudo invalide
        </div>';
    else if ($_GET['error'] == "passwordcheck")
        echo '<div class="alert alert-danger" role="alert">
        Les mots de passe ne correspondent pas
        </div>';
    if ($_GET['error'] == "usertaken")
        echo '<div class="alert alert-danger" role="alert">
        Pseudo déjà existant
        </div>';
    if ($_GET['error'] == "emailtaken")
        echo '<div class="alert alert-danger" role="alert">
        Email déjà existant
        </div>';
}

?>

    <div class="form-group">
        <input style="margin-bottom:5px;" type="email" name="mail" placeholder="E-mail" class="form-control">
        <input style="margin-bottom:5px;" type="text" name="username" placeholder="Nom d'utilisateur" class="form-control">
        <input style="margin-bottom:5px;" type="password" name="pwd" placeholder="Mot de passe" minlength='8' class="form-control">
        <input type="password" name="pwd2" placeholder="Confirmer mot de passe" minlength='8' class="form-control">
    </div>
    <button class="btn btn-primary btn-block" type="submit" name="signup">Signup</button>
    </form>
    <p class="hr">OU</p>
    <h6>Vous avez un compte ? <a href="index.php">Connectez-vous</a></h6>  


</div>

