<?php
require "header.php";
require "./config/database_connect.php";
$id = $_SESSION['id'];
?>



<body>
    <div class="container text-center">
        <form action="includes/camera.inc.php" method="post">
        <div class="camera">
            <video id="sourcevid"></video>
            <canvas id="cvs" height='480' width='480' style="display:none"></canvas><br>
            <button class="btn btn-primary" name="camupload" id='tar' onclick='capture()'>photo</button>
        </div>
        </form>

    </div>


</body>
<script>
	window.onload = OpenCam;
</script>
