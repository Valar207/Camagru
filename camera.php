<?php
require "header.php";
require "./config/database_connect.php";

if (isset($_SESSION['nameUsers']))
{
$id = $_SESSION['id'];
?>

<body>
    <div class="container profil text-center">

<?php

if (isset($_GET['error']))
{
    if ($_GET['error'] == 'stickerexists')
    echo '<div class="alert alert-danger" role="alert">
        Ce sticker existe déjà.
    </div>';
    if ($_GET['error'] == 'format')
    echo '<div class="alert alert-danger" role="alert">
        Ajoutez un sticker au format png.
    </div>';
}

?>




        <div class="row justify-content-between">
            <div class="camera col-md-7">
                <form action="includes/camera.inc.php" method="post" enctype="multipart/form-data">
                    <img draggable="false" class="overlay" name="sticker" id="overlay" src="">
                    <input  value="" type="hidden"  id="sticker_v" name="sticker_v">
                    <video id="sourcevid"></video>
                    <canvas id="cvs" height='480' width='480' style="display:none"></canvas><br>

                    <div class="row">
                        <div class="col-md-6 ">
                            <button class="btn btn-primary shot" name="camupload" id='tar' onclick='capture()'></button>
                        </div>
                        <div class="col-md-6">
                            <label class="modifpdp" for="upload" style="display:block; font-size:15px">Upload photo</label>
                            <input id="upload" type="file" name="file" accept="image/*" style="display:none;">
                            <button class="btn btn-primary" type="submit" name="submit">Valider</button>  
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-4 content-stickers">
                <div class="stickers">
                    <?php
                        $req = $bdd->prepare("SELECT * FROM stickers");
                        $req->execute();
                        while ($row = $req->fetch())
                        { ?>
                            <img width=200px src='<?php echo $row['sticker'] ?>' onclick='changeSticker(this.src)' class="sticker"><br>
                    <?php }
                    ?>
                </div>
                        <form action="includes/upload_sticker.inc.php" method="post" enctype="multipart/form-data">
                            <label class="modifpdp" for="upload2" style="display:block; font-size:15px">Upload sticker</label>
                            <input id="upload2" type="file" name="file2" accept="image/*" style="display:none;">
                            <button class="btn btn-primary" type="submit" name="submit2">Valider</button>  
                        </form>

           
            </div>
                             
        </div>

        <div class="row disp-shots">
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



