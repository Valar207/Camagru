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
<h1 class="text-center galerietxt">Galerie</h1>
<hr>
<div class="container galerie">



<?php
	$req = $bdd->prepare("SELECT * FROM pictures ORDER BY id_img DESC LIMIT ".$depart.",".$imgParPage);
	$req->execute();
	while ($row = $req->fetch())
		{
			?>
			<!-- display modals -->

				<img width=31% src="<?php echo $row['img'] ?>" alt="<?php echo $row['id_img'] ?>" id="modalimg" class="modalimg">
		<?php
		}?>

		<div id="mymodal" class="modal">
			<div class="modal-contentt">
				<img src="" alt="" id="imgmodal" class="imginmodal">
				<span class="closebtn">&times;</span>
				<form action="includes/add_comment.inc.php" method="post" class="col-sm-5" style="display:inline-block">
						<div class="col">


						<script>
							
						</script>

							<?php

							$id_img = 12;

							$req = $bdd->prepare("SELECT comment FROM comments WHERE id_img = :id_img");
							$req->execute(array('id_img' => $id_img));

							while ($com = $req->fetch()){
								print_r($com);
							}


							$req->closeCursor();


							?>



							<textarea class="form-control" name="com" placeholder="Ajouter un commentaire..." rows="3"></textarea>
							<button class="btn btn-primary btn-block" type="submit" name="save">Publier</button>
							<input type="hidden" value="" id="valimg" name="valimg">
						</div>
				</form>
			</div>
		</div>




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















