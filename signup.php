
<?php
require "header.php";

if (isset($_GET['error']))
{
    if ($_GET['error'] == 'emptyfields')
    echo 'Remplissez tous les champs';
    else if ($_GET['error'] == "invalidmailusername")
        echo 'Email et pseudo invalides';
    else if ($_GET['error'] == "invalidmail")
        echo 'Email invalide';
    else if ($_GET['error'] == "invalidusername")
        echo 'Pseudo invalide';
    else if ($_GET['error'] == "passwordcheck")
        echo 'Les mots de passe ne correspondent pas';
    if ($_GET['error'] == "usertaken")
        echo 'Pseudo déjà existant';
    if ($_GET['error'] == "emailtaken")
        echo 'Email déjà existant';
}

?>

<form action="includes/signup.inc.php" method="post">
    <input type="email" name="mail" placeholder="E-mail">
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="pwd" placeholder="Password" minlength='8'>
    <input type="password" name="pwd2" placeholder="Repeat password" minlength='8'>
    <button class="btn" type="submit" name="signup">Signup</button>
</form>
<p>Vous avez un compte ? <a href="index.php">Connectez-vous</a></p>
