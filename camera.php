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
        <div class="row justify-content-around">
            <div class="camera col-md-7 col-11">
                <form class="form-btn" action="includes/camera.inc.php" method="post" enctype="multipart/form-data">
                    <input  value="" type="hidden"  id="sticker_v" name="sticker_v">
                    <video class="video" id="sourcevid"></video>
                    <img draggable="false" id="upload-img" class="overlay-upload" width="100%">
                    <img draggable="false" class="overlay" name="sticker" id="overlay" src="">
                    <canvas id="cvs" height='480' width='480' style="display:none;"></canvas><br>
                    <div class="row shots" >
                        <div class="col-md-12">
                            <!-- BOUTTON CAPTURE VIDEO -->
                            <button class="btn btn-primary shot" name="camupload" id='tar' onclick='capture()'></button>
                        </div>


                        <div class="col-md-6 col-6" align="center">
                            <!-- BOUTTON CAPTURE UPLOADED IMAGE -->
                            <button class="btn btn-primary shot" name="imgupload" id='cap' onclick='capture_upload()' style="display:none;"></button>
                        </div>
                        <div class="col-md-6 col-6" align="center">
                            <label class="upload-btn" for="upload" name="file" id="upload_photo" style="display:none; font-size:15px">Upload photo</label>
                            <input id="upload" type="file" name="file" accept="image/*" onchange="loadFile(event)" style="display:none;">
                        </div>




                    </div>
                </form>
            </div>

            <div class="col-md-4 col-11 content-stickers">
                <div class="stickers">
                    <?php
                        $req = $bdd->prepare("SELECT * FROM stickers");
                        $req->execute();
                        while ($row = $req->fetch())
                        { ?>
                        <form action="includes/sticker.inc.php" method="post">
                            <input type="hidden" name="sticker" value="<?php echo $row['sticker'] ?>">
                            <button type="submit" name="delstick" value='<?php echo $row['sticker'] ?>' class="croix col-1" >&times;</button>
                            <img class="sticker col-10" width=200px src='<?php echo $row['sticker'] ?>' onclick='changeSticker(this.src)'><br>
                        </form>

                    <?php }
                    ?>
                </div>
                        <form action="includes/sticker.inc.php" method="post" enctype="multipart/form-data">
                            <label class="upload-btn stick" for="upload2" style="display:block; font-size:15px">Upload sticker</label>
                            <input id="upload2" type="file" name="file2" accept="image/*" onchange="submit()" style="display:none;">
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
                        <img width=100% src='<?php echo $row['img'] ?>' class="modalimg-preview">
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

    var loadFile = function(event) {
	var image = document.getElementById('upload-img');
	image.src = URL.createObjectURL(event.target.files[0]);
};
</script>

<?php }
else{
    header("Location: index.php");
}

?>

<footer class="whitefooter text-center">
	Camagru 2020 @vrossi
</footer>

