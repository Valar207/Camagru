<?php
require "header.php";

if (!isset($_SESSION['bio']))
{
    $_SESSION['bio'] = '';
}

    
?>

<div class="container edit_profil">
    <div class="row">
        <div class="col-md-4 nav-profil-left">
            <ul class="list-group list">
                <li class="list-group-item item"><a href="edit_profile.php">Modifier le profil</a></li>
                <li class="list-group-item item active"><a href="profile_changepwd.php">Changer de mot de passe</a></li>
                <li class="list-group-item item"><a href="profile_delaccount.php">Supprimer le compte</a></li>
            </ul>
        </div>
        <div class="col-md-8 nav-profil-right">
            <form action="./includes/profile_changepwd.inc.php" method="post" class="form-right">
            <div class="row" style="margin-bottom: 15px;">
                    <div class="col-sm-4 text-right">
                        <img src="<?php echo $_SESSION['img_p']; ?>" class="img-profil" alt="...">
                    </div>
                    <div class="col-sm-6">
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
                    else if ($_GET['error'] == 'pwdnomatch')
                        echo '<div class="col-sm-8 offset-sm-2 text-center alert alert-danger" role="alert">
                        Les mots de passe ne correspondent pas
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
                    <div class="col-sm-4 text-right">
                        <label for="mail" class="col-form-label">Ancien mot de passe</label>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" name="oldpwd">
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-4 text-right">
                        <label class="col-form-label">Nouveau mot de passe</label>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" name="newpwd" minlength='8'>
                    </div>
                </div>
                


                <div class="form-group row">
                    <div class="col-sm-4 text-right">
                        <label class="col-form-label">Confirmer le nouveau mot de passe</label>
                    </div>
                    <div class="col-sm-6">
                        <input style="height:60px;" type="password" class="form-control" name="newpwd2" minlength='8'>                    
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-4 text-right"></div>
                    <div class="col-sm-6">
                        <button class="btn btn-primary btn-block" type="submit" name="save">Modifier</button>  
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>