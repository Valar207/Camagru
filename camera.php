<?php
require "header.php";
require "./config/database_connect.php";
$id = $_SESSION['id'];
?>



<body>
    <div class="container profil text-center">

        <div class="row">

            <div class="camera col">
            <form action="includes/camera.inc.php" method="post">
                <img draggable="false" class="overlay" src="./stickers/frame.png">
                <video id="sourcevid"></video>
                <canvas id="cvs" height='480' width='480' style="display:none"></canvas><br>
                <button class="btn btn-primary" name="camupload" id='tar' onclick='capture()'>photo</button>
            </form>
            </div>

            <div class="col">
                <p>coucou</p>
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