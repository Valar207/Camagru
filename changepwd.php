<?PHP 

require "./header.php";

if (isset($_GET['error']))
{
    if ($_GET['error'] == 'emptyfield')
        echo 'Remplissez tous les champs';
    if ($_GET['error'] == 'pwd_no_match')
        echo 'Les mots de passe ne correspondent pas';
}
if (isset($_GET['changepwd']))
{
    if ($_GET['changepwd'] == 'success')
        echo 'Votre mot de passe a bien été modifié';
}
else
{
    echo '<form action="./includes/changepwd.inc.php" method="post">
    <input type="password" name="pwd1" placeholder="Nouveau mot de passe" minlength="8">
    <input type="password" name="pwd2" placeholder="Retapez mot de passe" minlength="8">
    <button class="btn" type="submit" name="reset_pwd">Envoyer un lien de connexion</button>
    </form>';
}

echo '<br><a href="index.php">Revenir à l\'écran de connexion</a>';


?>