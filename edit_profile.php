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
                <li class="list-group-item item active"><a href="edit_profile.php">Modifier le profil</a></li>
                <li class="list-group-item item"><a href="profile_changepwd.php">Changer de mot de passe</a></li>
                <li class="list-group-item item"><a href="notification.php">Notifications</a></li>
                <li class="list-group-item item"><a href="profile_delaccount.php">Supprimer le compte</a></li>
            </ul>
        </div>
        <div class="col-md-8 nav-profil-right">
        <div class="row" style="margin-bottom: 15px; margin-top: 20px;">
                    <div class="col-sm-4 col-3 text-right">
                        <img src="<?php echo $_SESSION['img_p']; ?>" class="img-profil-edit">
                    </div>
                    <div class="col-sm-6 col-9">
                        <h1><?php echo $_SESSION['nameUsers']; ?></h1>
                        <form action="includes/upload_imgprofile.inc.php" method="post" enctype="multipart/form-data">
                            <label class="modifpdp" for="upload" style="display:inline-block; font-size:15px">Modifier la photo de profil</label>
                            <input id="upload" type="file" name="file" accept="image/*" style="display:none;">
                            <button class="btn btn-primary upload-img" type="submit" name="submit" style="display:block">Valider</button>  
                        </form>

                    </div> 
                </div>
            <form action="./includes/edit_profile.inc.php" method="post" class="form-right">
                

                <?php

                if (isset($_GET['success']))
                {
                    if ($_GET['success'] == 'usermailmodified')
                        echo '<div class="col-sm-8 offset-sm-2 text-center alert alert-success" role="alert">
                        Nom d\'utilisateur et adresse mail modifiés.
                        </div>';
                    else if ($_GET['success'] == 'userbiomodified')
                        echo '<div class="col-sm-8 offset-sm-2 text-center alert alert-success" role="alert">
                        Nom d\'utilisateur et biographie modifié.
                        </div>';
                    else if ($_GET['success'] == 'mailbiomodified')
                        echo '<div class="col-sm-8 offset-sm-2 text-center alert alert-success" role="alert">
                        Adresse mail et biographie modifiée.
                        </div>';
                    else if ($_GET['success'] == 'usermodified')
                        echo '<div class="col-sm-8 offset-sm-2 text-center alert alert-success" role="alert">
                        Nom d\'utilisateur modifié.
                        </div>';
                    else if ($_GET['success'] == 'mailmodified')
                        echo '<div class="col-sm-8 offset-sm-2 text-center alert alert-success" role="alert">
                        Adresse mail modifiée.
                        </div>';
                    else if ($_GET['success'] == 'biomodified')
                        echo '<div class="col-sm-8 offset-sm-2 text-center alert alert-success" role="alert">
                        Biographie modifiée.
                        </div>';
                    else if ($_GET['success'] == 'usermailbiomodified')
                        echo '<div class="col-sm-10 offset-sm-1 text-center alert alert-success" role="alert">
                        Adresse mail, nom d\'utilisateur et biographie modifiée.
                        </div>';
                }
                if (isset($_GET['upload']))
                {
                    if ($_GET['upload'] == 'success')
                        echo '<div class="col-sm-10 offset-sm-1 text-center alert alert-success" role="alert">
                        Photo de profil enregistrée.
                        </div>';
                    if ($_GET['upload'] == 'fail')
                        echo '<div class="col-sm-10 offset-sm-1 text-center alert alert-danger" role="alert">
                        Veuillez sélectionner une image.
                        </div>';
                }



            ?>
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
                        <button class="btn btn-primary btn-block modifp" type="submit" name="save">Modifier</button>  
                    </div>
                </div>
            </form>



        </div>
    </div>
</div>