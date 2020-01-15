<?php
require "header.php";
require "./config/database_connect.php";
$id = $_SESSION['id'];
?>



<body>
<form action="includes/camera.inc.php" method="post">
	<div class="camera">
        <video id="sourcevid"></video>
        <canvas id="cvs" height='480' width='480' style="display:none"></canvas>
        <button name="camupload" id='tar' onclick='capture()' style='height:50px;width:80px;margin:auto'>photo</button>
    </div>
</form>

</body>
<script>
	window.onload = OpenCam;
</script>
