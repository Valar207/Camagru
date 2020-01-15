<?PHP
require "./header.php";
?>

<div class="login-form">
<form action="./includes/changepwd_link.inc.php" method="post">
<h1 class="camagru">Camagru</h1>
<?php
if (isset($_GET['error']))
{
    if ($_GET['error'] == 'emptyfield')
        echo '<div class="alert alert-danger" role="alert">
        Remplissez tous les champs
        </div>';
}
if (isset($_GET['mail']))
{
    if ($_GET['mail'] == 'sent')
        echo '<div class="alert alert-success" role="alert">
        Le mail de changement de mot de passe a bien été envoyé
        </div>';
    if ($_GET['mail'] == 'no_exists')
        echo '<div class="alert alert-danger" role="alert">
        email or user doesn\'t exist
        </div>';
}
?>
    <div class="form-group">
        <input type="text" name="mail" placeholder="E-mail ou nom d'utilisateur" class="form-control">
    </div>
    <button class="btn btn-primary btn-block" type="submit" name="reset" class="form-control">Envoyer un lien de connexion</button>
</form>
<p class="hr">OU</p>
<a class="create-account" href="inscription.php"><p class="create-account">Créer un compte</p></a>
<div class="bottom-back">
<a class="back-to-log" href="index.php"><p class="back-to-log">Revenir à l'écran de connexion</p></a>
</div>

</div>