<?php
require "header.php";
require "./config/database_connect.php";

$id_img = $_GET['id_img'];
$page =$_GET['page'];

?>

<!DOCTYPE html>
<html lang="en">

<body class="behind">
    
<div class="container-fluid margin">
    <div class="container fakemod">
    <a href="galerie.php?page=<?php echo $_GET['page'] ?>">
    <span class="close">&times;</span>
    </a>

        
        <div class="row">
            <div class="col img_modal">
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
                                                        //header("Location: photo.php?id_img=$id_img&page=$page");
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

                <div class="col right-col">
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
                        <form action="includes/add_comment.inc.php" method="post">
                            <input type="hidden" value="<?php echo $id_img ?>" name="id_img">
                            <input type="hidden" value="<?php echo $page ?>" name="page">
                            <button class="like_on" type="submit"  name="like">
                                <img style="width:20px;" src="icones/like.svg">
                            </button>
                        </form>
                        
                        <?php
                            
                            $req = $bdd->prepare("SELECT `like` FROM pictures WHERE id_img=:id_img");
                            $req->execute(array('id_img' => $id_img));
                            if ($row = $req->fetch()){
                                $nb_like = $row['like'];
                            }
                        ?>
                        <span> <?php echo $nb_like ?></span>
                    </div>

                    <hr style="margin-left:-30px">
                    <form autocomplete="off" action="includes/add_comment.inc.php" method="post" class="col">
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

