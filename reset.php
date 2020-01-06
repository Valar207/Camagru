<?PHP
require "./header.php";

if (isset($_GET['error']))
{
    if ($_GET['error'] == 'emptyfield')
        echo 'Remplissez tous les champs';
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