<?php
require "header.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Galerie</title>
</head>
<body>
	

<?php
if(isset($_SESSION['nameUsers']))
{
	echo '<a href="camera.php" class="button">Prendre une photo</a><br>';
	echo 'LA GALERIIIIE';

}
else
{
	echo 'LA GALERIIIIE';



}
?>




</body>
</html>