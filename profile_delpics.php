<?php
require "header.php";

?>

<div class="container edit_profil">
    <div class="row">
        <div class="col-md-4 nav-profil-left">
            <ul class="list-group list">
                <li class="list-group-item item"><a href="edit_profile.php">Modifier le profil</a></li>
                <li class="list-group-item item"><a href="profile_changepwd.php">Changer de mot de passe</a></li>
                <li class="list-group-item item"><a href="profile_delaccount.php">Supprimer le compte</a></li>
                <li class="list-group-item item active"><a href="profile_delpics.php">Gérer les photos</a></li>
            </ul>
        </div>
        <div class="col-md-8 nav-profil-right">
        <div class="row" style="margin-bottom: 15px; margin-top: 20px;">
                    <div class="col-sm-4 text-right">
                        <img src="<?php echo $_SESSION['img_p']; ?>" class="img-profil-edit" alt="...">
                    </div>
                    <div class="col-sm-6">
                        <h1><?php echo $_SESSION['nameUsers']; ?></h1>

                    </div>
                </div>
            <form action="./includes/edit_profile.inc.php" method="post" class="form-right">
                

                <?php

               


                ?>
                <div class="form-group row" style="margin-top:20px;">
                    <div class="col-sm-4 text-right">
                        <label class="col-form-label">Email</label>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="mail" value="<?php echo $_SESSION['mail']; ?>">
                    </div>
                </div>

                <input class="del_img" type="image" src="public/picture/val/pictures/val(11).png" alt="60" value="0" style="border-color: rgba(255, 255, 255, 0);">


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