<?php
require "header.php";
require "./config/database_connect.php";
$id = $_SESSION['id'];
?>



<body>
<form action="includes/camera.inc.php" method="post">
	<div class="camera">
        <video id="sourcevid" height='480' width='800'></video>
		<div id="main" style='height:150px;width:150px;margin:auto;display:inline'>
            <canvas id="cvs" height='480' width='800' style="display:none"></canvas>
		</div>
        <button name="camupload" id='tar' onclick='capture()' style='height:50px;width:80px;margin:auto'>photo</button>
    </div>
</form>

</body>
<script>
	window.onload = OpenCam;
</script>

    <?php
		// if(isset($_POST['camupload']))
		// {
        //     $base64 = $_POST['camupload'];
		// 	list($src, $base64) = explode(';', $base64);
		// 	list($base64, $data) = explode(',', $base64);
        //     $data = base64_decode($data);
        //     $source_img = imagecreatefromstring($data);
        //     imageflip($source_img, IMG_FLIP_HORIZONTAL);

        //     /*store img_nbr in SESSION*/
        //     $req = $bdd->prepare("SELECT * FROM users WHERE idUsers= :id");
        //     $req->execute(array('id' => $id));
        //     if ($row = $req->fetch())
        //         $_SESSION['img_nbr'] = $row['img_nbr'];
        //     $req->closeCursor();
            
        //     /*increment img_nbr*/
        //     $req = $bdd->prepare("UPDATE users SET img_nbr = img_nbr+1 WHERE idUsers= :id");
        //     $req->execute(array('id' => $id));
        //     $req->closeCursor();

        //     $imageSave = imagepng($source_img, './post_img/'.$_SESSION['nameUsers'].'_'.$_SESSION['img_nbr'].'.png');
        //     imagedestroy($source_img);
        // }
        // else{
        //     echo 'no';
        // }
	?>

