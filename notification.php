<?php
require "header.php";

$id_user = $_SESSION['id'];
if (!isset($_SESSION['bio']))
{
    $_SESSION['bio'] = '';
}

$req = $bdd->prepare("SELECT notif_com FROM users WHERE idUsers = :id_user");
$req->execute(array('id_user' => $id_user));
$notif_com = $req->fetch()['notif_com'];

$req = $bdd->prepare("SELECT notif_like FROM users WHERE idUsers = :id_user");
$req->execute(array('id_user' => $id_user));
$notif_like = $req->fetch()['notif_like'];
    
if (isset($_SESSION['nameUsers']))
{
$id = $_SESSION['id'];
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

                <table class="table">
                <tbody>
                    <tr>
                        <td></td>
                        <td><h5>Nouveau commentaire</h5></td>
                    </tr>
                    <tr>
                        <td>
                        <div class="custom-control custom-switch">
                            <input <?php if ($notif_com == 1){echo 'checked';} ?> type="checkbox" class="custom-control-input" name="notif_com" onChange="submit()" id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1"></label>
                        </div>
                    </td>
                        <td>Recevoir une notification par mail</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><h5>Nouveau like</h5></td>
                    </tr>
                    <tr>
                        <td>
                        <div class="custom-control custom-switch">
                            <input <?php if ($notif_like == 1){echo 'checked';} ?> type="checkbox" class="custom-control-input" name="notif_like" onChange="submit()" id="customSwitch2">
                            <label class="custom-control-label" for="customSwitch2"></label>
                        </div>
                    </td>
                        <td>Recevoir une notification par mail</td>
                    </tr>
                    <tr>
                    </tr>
                </tbody>
                </table>
            </form>



        </div>
    </div>
</div>

<?php }
else{
    header("Location: index.php");
}

?>