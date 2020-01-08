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
            <form action="./includes/profile_changepwd.inc.php" method="post" class="form-right">


                <div class="form-group row" style="margin-top:20px;">
                    <div class="col-sm-5 text-right">
                        <label for="mail" class="col-form-label">Ancien mot de passe</label>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="oldpwd">
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-5 text-right">
                        <label class="col-form-label">Nouveau mot de passe</label>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="newpwd">
                    </div>
                </div>
                


                <div class="form-group row">
                    <div class="col-sm-5 text-right">
                        <label class="col-form-label">Confirmer mot de passe</label>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="newpwd2">                    
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-5 text-right"></div>
                    <div class="col-sm-6">
                        <button class="btn btn-primary btn-block" type="submit" name="save">Save</button>  
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>