<?php
require "header.php";

if (!isset($_SESSION['bio']))
{
    $_SESSION['bio'] = '';
}
    
?>

<div class="container profil">
    <div class="row">
        <div class="col-md-3 nav-profil-left">
            <a href="profile.php">Modifier le profil</a>
            <a href="profile_changepwd.php">Changer de mot de passe</a>
        </div>
        <div class="col-md-9 nav-profil-right">
            <form action="./includes/change_profile.inc.php" method="post" class="form-right">
                <div class="row">
                    <div class="col-sm-4 text-right">
                        <img src="./img/exp.jpeg" class="img-profil" alt="...">
                    </div>
                    <div class="col-sm-6">
                        <h1><?php echo $_SESSION['nameUsers']; ?></h1>
                    </div>
                </div>
                <div class="form-group row" style="margin-top:20px;">
                    <div class="col-sm-4 text-right">
                        <label class="col-form-label">Email</label>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="mail" value="<?php echo $_SESSION['mail']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4 text-right">
                        <label class="col-form-label">Nom d'utilisateur</label>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="username" value="<?php echo $_SESSION['nameUsers']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4 text-right">
                        <label class="col-form-label">Bio</label>
                    </div>
                    <div class="col-sm-6">
                        <textarea class="form-control" name="bio" rows="3"><?php echo $_SESSION['bio']; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4 text-right"></div>
                    <div class="col-sm-6">
                        <button class="btn btn-primary btn-block" type="submit" name="save">Save</button>  
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>