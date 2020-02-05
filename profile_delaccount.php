<?php
require "header.php";

if (isset($_SESSION['nameUsers']))
{
?>
<div class="container edit_profil">
    <div class="row">
        <div class="col-md-4 nav-profil-left">
            <ul class="list-group list">
                <li class="list-group-item item"><a href="edit_profile.php">Modifier le profil</a></li>
                <li class="list-group-item item"><a href="profile_changepwd.php">Changer de mot de passe</a></li>
                <li class="list-group-item item"><a href="notification.php">Notifications</a></li>
                <li class="list-group-item item active"><a href="profile_delaccount.php">Supprimer le compte</a></li>
            </ul>
        </div>
        <div class="col-md-8 nav-profil-right">
            <form action="./includes/profile_delaccount.inc.php" method="post" class="form-right">
            <div class="row" style="margin-bottom: 15px;">
                    <div class="col-sm-4 col-3 text-right">
                        <img src="<?php echo $_SESSION['img_p']; ?>" class="img-profil-edit" alt="...">
                    </div>
                    <div class="col-sm-6 col-9 ">
                        <h1><?php echo $_SESSION['nameUsers']; ?></h1>
                    </div>
            </div>
            <?php

                if (isset($_GET['error']))
                {
                    if ($_GET['error'] == 'wrongpwd')
                        echo '<div class="col-sm-8 offset-sm-2 text-center alert alert-danger" role="alert">
                        Mauvais mot de passe
                        </div>';
                    else if ($_GET['error'] == 'emptyfields')
                        echo '<div class="col-sm-8 offset-sm-2 text-center alert alert-danger" role="alert">
                        Remplissez tous les champs
                        </div>';
                }
                if (isset($_GET['success']))
                {
                    if ($_GET['success'] == 'pwdchanged')
                        echo '<div class="col-sm-8 offset-sm-2 text-center alert alert-success" role="alert">
                        Mot de passe modifié !
                        </div>';
                }

            ?>
                <div class="form-group row" style="margin-top:20px;">
                    <div class="col-sm-10 offset-sm-1 text-center">
                        <p style="color:red; margin-top: 5px;">Attention la suppression de votre compte sera définitive !</p>
                    </div>
                </div>
                <div class="form-group row" style="margin-top:20px;">
                    <div class="col-sm-4 text-right">
                        <label class="col-form-label">Entrez votre mot de passe</label>
                    </div>
                    <div class="col-sm-6">
                        <input style="height:60px;" type="password" class="form-control" name="pwd">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4 text-right"></div>
                    <div class="col-sm-6">
                        <button class="btn btn-primary btn-block modifp" type="submit" name="delete">Supprimer</button>  
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<footer class="whitefooter text-center">
	Camagru 2020 @vrossi
</footer>

<?php }
else{
    header("Location: index.php");
}

?>
