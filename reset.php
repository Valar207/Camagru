<?PHP
require "./header.php";

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
        echo 'Le mail de changement de mot de passe a bien été envoyé';
    if ($_GET['mail'] == 'no_exists')
        echo 'email or user doesn\'t exist';
}
if (!isset($_GET['username']) && !isset($_GET['error_np']))
{
    echo '<form action="./includes/reset_link.inc.php" method="post">
            <input type="text" name="mail" placeholder="Username/e-mail">
            <button class="btn" type="submit" name="reset">Envoyer un lien de connexion</button>
        </form>';
}

echo '<br><a href="index.php">Revenir à l\'écran de connexion</a>';

?>

<div class="login-form">
<form action="./includes/reset_link.inc.php" method="post">
<h1 class="camagru">Camagru</h1>
<?php
if (isset($_GET['error']))
{
    if ($_GET['error'] == 'emptyfield')
        echo '<div class="alert alert-danger" role="alert">
        Remplissez tous les champs
        </div>';
}
?>
    <div class="form-group">
        <input type="text" name="mail" placeholder="E-mail ou nom d'utilisateur" class="form-control">
    </div>
    <button class="btn btn-primary btn-block" type="submit" name="reset" class="form-control">Envoyer un lien de connexion</button>
</form>
<p class="hr">OU</p>
<a href="signup.php"><p class="create-account">Créer un compte</p></a>
<div class="bottom-back">
<a href="index.php"><p class="back-to-log">Revenir à l'écran de connexion</p></a>
</div>

</div>