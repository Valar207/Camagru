<?php
require "header.php";
require "./config/database_connect.php";

$id_img = $_GET['id_img'];
$page =$_GET['page'];

$req = $bdd->prepare("SELECT * FROM pictures WHERE id_img = :id_img");
$req->execute(array('id_img' => $id_img));
if ($req->rowCount() == 0){
    echo 'page non existante';
    exit;
}


if(!is_numeric($id_img) || !is_numeric($page)){
    echo 'page non existante';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<body class="behind">
    
<div class="container-fluid margin">
    <div class="container fakemod">

    <?php if(isset($_GET['profil']) && $_GET['profil'] == 'yes'){
        
    ?>
            <a href="profile.php?page=<?php echo $_GET['page'] ?>">
                <p class="close">&times;</p>
            </a>

    <?php } 
    else{
        ?>
    <a href="galerie.php?page=<?php echo $_GET['page'] ?>">
        <p class="close">&times;</p>
    </a>
    <?php } ?>

        
        <div class="row">
            <div class="col-12 col-md-12 col-lg-8 img_modal">
                <?php
                    if (isset($_GET['a'])){
                        if ($_GET['a'] == 0){
                            $req = $bdd->prepare("SELECT * FROM comments 
                                                INNER JOIN users ON comments.id_user = users.idUsers 
                                                INNER JOIN pictures ON comments.id_img = pictures.id_img WHERE
                                                pictures.id_user = :id_user AND idUsers != :id_user");
                                                if ($req->execute(array('id_user' => $_SESSION['id']))){
                                                        $req = $bdd->prepare("UPDATE comments SET active = 0 WHERE id_img = :id_img");
                                                        $req->execute(array('id_img' => $id_img));
                                                        $req = $bdd->prepare("UPDATE likes SET active = 0 WHERE id_img = :id_img");
                                                        $req->execute(array('id_img' => $id_img));
                                                }
                        }
                    }
                    $req = $bdd->prepare("SELECT img FROM pictures WHERE id_img=:id_img");
                    $req->execute(array('id_img' => $id_img));
                    if ($row = $req->fetch()){
                        $img = $row['img'];
                    }
                ?>
                    <img style="width:100%;" src="<?php echo $img;?>">
            </div>

                    <!-- IF CONNECTED -->
            <?php
                if (isset($_SESSION['nameUsers'])){?>

                <div class="col-12 col-md-12 col-lg-4 right-col">
                            <?php
                                $req = $bdd->prepare("SELECT users.img, nameUsers FROM users INNER JOIN pictures ON users.idUsers = pictures.id_user
                                                        WHERE pictures.id_img = :id_img");
                                $req->execute(array('id_img' => $id_img));
                                if ($row = $req->fetch()){
                                    $img_user = $row['img'];
                                    $name_user = $row['nameUsers'];
                                }
                            ?>
                            <table class="table">
                            <tbody>
                                <tr >
                                    <td class="text-center"><img src="<?php echo $img_user;?>" class="img-profil"></td>
                                    <td class="text-left"><h3 style="display:inline-block;"><?php echo $name_user;?></h3><td>
                                </tr>
                            </tbody>
                            </table>

                
                            

                    <div class="comments">
                                <?php
                                    $req = $bdd->prepare("SELECT `comment`, `nameUsers`, `img`, `date` FROM
                                    comments INNER JOIN users ON users.idUsers = comments.id_user WHERE id_img=:id_img ORDER BY `date` ASC");
                                    $req->execute(array('id_img' => $id_img));
                                    while ($row = $req->fetch()){
                                        $com = $row['comment'];
                                        $user = $row['nameUsers'];
                                        $profile_pic = $row['img'];
                                        $date_com = $row['date'];
                                ?>
                                    <img src="<?php echo $profile_pic;?>" class="profile_p_com">&nbsp
                                    <h4 style="display:inline-block;"><?php echo $user;?>&nbsp </h4>
                                    <p style="display:inline-block;width:300px;word-wrap: break-word;"><?php echo $com;  ?></p>
                                    <p style="font-size:12px;color:#999; margin-bottom:0px;"><?php echo $date_com;  ?></p>
                                    <br>                       
                                <?php } ?>
                    </div>


                    <div class="like">
                    <?php
                            
                            $req = $bdd->prepare("SELECT `like` FROM pictures WHERE id_img=:id_img");
                            $req->execute(array('id_img' => $id_img));
                            if ($row = $req->fetch()){
                                $nb_like = $row['like'];
                            }
                        ?>
                        
                        <form action="includes/add_comment.inc.php" method="post">
                            <input type="hidden" value="<?php echo $id_img ?>" name="id_img">
                            <input type="hidden" value="<?php echo $page ?>" name="page">
                            <button class="like_on" type="submit"  name="like">
                                <img style="width:20px;" src="icones/like.svg">   <?php echo $nb_like ?>
                            </button>
                        </form>
                        

                    </div>

                    <hr>
                    <form autocomplete="off" action="includes/add_comment.inc.php" method="post" class="row justify-content-around">
                                <input type="hidden" value="<?php echo $id_img ?>" name="id_img">
                                <input type="hidden" value="<?php echo $page ?>" name="page">
                                <input class="form-control form_com" name="com" required="required" pattern="{1,120}" placeholder="Ajouter un commentaire..." rows="3">
                                <button class="btn pub-com" type="submit" name="save">Publier</button>
                    </form> 
                </div>
                    <!-- IF NOT CONNECTED -->
            <?php    }
            else { 
                ?>
                <div class="col right-col">
                            <?php
                                $req = $bdd->prepare("SELECT users.img, nameUsers FROM users INNER JOIN pictures ON users.idUsers = pictures.id_user
                                                        WHERE pictures.id_img = :id_img");
                                $req->execute(array('id_img' => $id_img));
                                if ($row = $req->fetch()){
                                    $img_user = $row['img'];
                                    $name_user = $row['nameUsers'];
                                }
                            ?>
                            <tr class="">
                                <td><img src="<?php echo $img_user;?>" class="img-profil"></td>
                                <td><h3 style="display:inline-block;"><?php echo $name_user;?></h3><td>
                            </tr>
                <div class="comments">
                            <?php
                                $req = $bdd->prepare("SELECT `comment`, `nameUsers`, `img`, `date` FROM comments 
                                                    INNER JOIN users ON users.idUsers = comments.id_user 
                                                    WHERE id_img=:id_img ORDER BY `date` ASC");
                                $req->execute(array('id_img' => $id_img));
                                while ($row = $req->fetch()){
                                    $com = $row['comment'];
                                    $user = $row['nameUsers'];
                                    $profile_pic = $row['img'];
                                    $date_com = $row['date'];
                            ?>
                                <img src="<?php echo $profile_pic;?>" class="profile_p_com">&nbsp
                                <h4 style="display:inline-block;"><?php echo $user;?>&nbsp </h4>
                                <p style="display:inline-block;width:300px;word-wrap: break-word;"><?php echo $com;  ?></p>
                                <p style="font-size:12px;color:#999; margin-bottom:0px;"><?php echo $date_com;  ?></p>
                                <br>                       
                            <?php } ?>
                </div>
                <div class="like">
                       
                                <img style="width:20px;" src="icones/like.svg">
                        
                        <?php
                            
                            $req = $bdd->prepare("SELECT `like` FROM pictures WHERE id_img=:id_img");
                            $req->execute(array('id_img' => $id_img));
                            if ($row = $req->fetch()){
                                $nb_like = $row['like'];
                            }
                        ?>
                        <span> <?php echo $nb_like ?></span>
                    
                </div>
            </div>

            <?php    
            }
            ?>

        </div>



    </div>
</div>
</body>
</html>
