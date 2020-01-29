<?php
require "header.php";
require "./config/database_connect.php";

if (isset($_SESSION['nameUsers']))
{
$id = $_SESSION['id'];
?>

<body>
    <div class="container profil text-center">

        <div class="row">

            <div class="camera col-md-8">
            <form action="includes/camera.inc.php" method="post" enctype="multipart/form-data">
                <img draggable="false" class="overlay" name="sticker" id="overlay" src="">
                <input  value="" type="hidden"  id="sticker_v" name="sticker_v">
                <video id="sourcevid"></video>
                <canvas id="cvs" height='480' width='480' style="display:none"></canvas><br>
                <button class="btn btn-primary" name="camupload" id='tar' onclick='capture()'>Photo</button>


                <label class="modifpdp" for="upload" style="display:inline-block; font-size:15px">Upload image</label>
                <input id="upload" type="file" name="file" accept="image/*" style="display:none;">
                <button class="btn btn-primary" type="submit" name="submit" style="display:inline-block">Valider</button>  

            </form>
          
            </div>

            <div class="col-md-3 stickers" id="sticker">

                <?php
                    $req = $bdd->prepare("SELECT * FROM stickers");
                    $req->execute();
                    while ($row = $req->fetch())
                    { ?>
                        <img width=150px src='<?php echo $row['sticker'] ?>' onclick='changeSticker(this.src)' class="sticker"><br>
                   <?php }
                ?>

            </div>

        </div>

        <div class="row">
            <?php
                $req = $bdd->prepare("SELECT * FROM pictures WHERE id_user= :id ORDER BY `date` DESC");
                $req->execute(array('id' => $id));
                while ($row = $req->fetch())
                {
                    ?>
                    <div class="col-4 text-center" style="padding: 0.5% 1% 0.5% 1%;">
                        <img width=100% src='<?php echo $row['img'] ?>' class="modalimg">
                        <br>
                        <input type="hidden" name="pagecourante" value='<?php echo $pagecourante ?>'>
                        <input type="hidden" name="id_img" value="<?php echo $row['id_img'] ?>">
                    </div>
                <?php }
            ?>
        </div>
        

    </div>


</body>

<script>
    window.onload = OpenCam;
</script>

<?php }
else{
    header("Location: index.php");
}

?>



