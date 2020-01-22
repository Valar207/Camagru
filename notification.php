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
                <li class="list-group-item item"><a href="profile_changepwd.php">Changer de mot de passe</a></li>
                <li class="list-group-item item active"><a href="notification.php">Notifications</a></li>
                <li class="list-group-item item"><a href="profile_delaccount.php">Supprimer le compte</a></li>
            </ul>
        </div>
        <div class="col-md-8 nav-profil-right">
            <form action="./includes/notification.inc.php" method="post" class="form-right">
            <div class="row" style="margin-bottom: 15px;">
                    <div class="col-sm-4 text-right">
                        <img src="<?php echo $_SESSION['img_p']; ?>" class="img-profil-edit" alt="...">
                    </div>
                    <div class="col-sm-6">
                        <h1><?php echo $_SESSION['nameUsers']; ?></h1>
                    </div>
            </div>
            <?php

                if (isset($_GET['error']))
                {
                   
                }
                if (isset($_GET['success']))
                {

                }

            ?>
                <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td></td>
                        <td><h5>Nouveau commentaire</h5></td>
                    </tr>
                    <tr>
                        <td><input class="input" type="checkbox" name="notif_com" value="1"></td>
                        <td>Recevoir une notification par mail</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><h5>Nouveau like</h5></td>
                    </tr>
                    <tr>
                        <td><input class="input" type="checkbox" name="notif_like" value="1"></td>
                        <td>Recevoir une notification par mail</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button type="submit" name="submit">Valider</button></td>
                    </tr>
                </tbody>
                </table>
            </form>



        </div>
    </div>
</div>