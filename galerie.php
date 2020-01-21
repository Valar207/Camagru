<?php
require "header.php";
require "./config/database_connect.php";

$imgParPage = 9;
$req = $bdd->prepare("SELECT id_img FROM pictures");
$req->execute();
$imgtot = $req->rowCount();
$req->closeCursor();
$pagestot = ceil($imgtot / $imgParPage);

if (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] <= $pagestot){
	$_GET['page'] = intval($_GET['page']);
	$pagecourante = $_GET['page'];
}
else{
	$pagecourante = 1;
}
$depart = ($pagecourante - 1) * $imgParPage;
?>

<!-- display gallerie -->

<div class="container galerie">
<h1 class="text-center galerietxt">Galerie</h1>
<hr>


<?php
	$req = $bdd->prepare("SELECT * FROM pictures ORDER BY id_img DESC LIMIT ".$depart.",".$imgParPage);
	$req->execute();
	while ($row = $req->fetch())
		{
			?>
				<a href="photo.php?id_img=<?php echo $row['id_img'] ?>&page=<?php echo $pagecourante ?>">
				<img width=31% src="<?php echo $row['img'] ?>" alt="<?php echo $row['id_img'] ?>" id="modalimg" name="id_img" class="modalimg">				
				</a>
		<?php
		}?>

		<!-- display modals -->
		<!-- <div id="mymodal" class="modal">
			<div class="modal-contentt">
				<img src="" alt="" id="imgmodal" class="imginmodal">
				<span class="closebtn">&times;</span>
				<form action="includes/add_comment.inc.php" method="post" class="col-sm-5" style="display:inline-block">
						<div class="col">
						<input type="hidden" value="" id="id_img" name="id_img">

							<textarea class="form-control" name="com" placeholder="Ajouter un commentaire..." rows="3"></textarea>
							<button class="btn btn-primary btn-block" type="submit" name="save">Publier</button>
							<input type="hidden" value="" id="valimg" name="valimg">
						</div>
				</form>
			</div>
		</div> -->




<!-- Pagination -->
<nav aria-label="Page navigation" class="center">
  <ul class="pagination justify-content-center ">
	<?php
		if ($pagecourante == 1)
			echo '<li class="page-item disabled"><a class="page-link"><<</a></li>';
		else
			echo '<li class="page-item"><a class="page-link" href="galerie.php?page='.($pagecourante - 1).'"><<</a></li>';
		for($i=1; $i<=$pagestot;$i++){
			if($i == $pagecourante)
				echo '<li class="page-item active"><a class="page-link">'.$i.'</a></li>';
			else
				echo '<li class="page-item"><a class="page-link" href="galerie.php?page='.$i.'">'.$i.'</a></li>';
		}
		if ($pagecourante == $pagestot)
			echo '<li class="page-item disabled"><a class="page-link">>></a></li>';
		else
			echo '<li class="page-item"><a class="page-link" href="galerie.php?page='.($pagecourante + 1).'">>></a></li>';
	?>
  </ul>
</nav>



</div>
</div>

<script src="js/script.js?version=55">



</script>















