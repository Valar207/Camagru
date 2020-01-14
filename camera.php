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
        $req = $bdd->prepare("SELECT * FROM pictures WHERE id_user= :id ORDER BY `date` DESC");
        $req->execute(array('id' => $id));
        
    
        while ($row = $req->fetch())
        {
            echo '<div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                    <img src='.$row['img'].' class="">
                </div>
            </div>
        </div>';
        }
    
    
        $req->closeCursor();
	?>

