<?PHP 
require "./header.php";

?>

<div class="login-form">
<h1 class="camagru">Camagru</h1>
    <form action="./includes/changepwd.inc.php" method="post">
<?PHP 
    if (!isset($_GET['correct'])){
        if ($_GET['correct'] !== 'yes')
            header('Location:index.php');
        else
            header('Location:index.php');
    }

    if (isset($_GET['error']))
    {
        if ($_GET['error'] == 'emptyfield')
            echo '<div class="alert alert-danger" role="alert">
            Remplissez tous les champs
            </div>';
        if ($_GET['error'] == 'pwd_no_match')
            echo '<div class="alert alert-danger" role="alert">
            Les mots de passe ne correspondent pas
            </div>';
    }

?>
        <div class="form-group text-center">
            <input type="password" required="" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" style="margin-bottom:5px;" name="pwd1" placeholder="Nouveau mot de passe" minlength="8" class="form-control">
            <input type="password" required="" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" name="pwd2" placeholder="Confirmer mot de passe" minlength="8" class="form-control">
            <span class="pwd-check">Votre mot de passe doit contenir minimum 8 caractères, au moins un chiffre, une minuscule et une majuscule.</span>        
        </div>
        <button class="btn btn-primary btn-block" type="submit" name="reset_pwd">Modifier</button>
        
    </form>
    <div class="bottom-back" style="margin-top:20px;">
        <a href="index.php"><p class="back-to-log">Revenir à l'écran de connexion</p></a>
    </div>
</div>
<footer class="whitefooter text-center">
	Camagru 2020 @vrossi
</footer>