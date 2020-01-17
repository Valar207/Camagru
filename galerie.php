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


<!-- modal example -->
<!-- <button id="modalbtn" class="button">Modal</button> -->






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

<!-- <script src="js/script.js?version=55"> -->
<script>
var modal = document.getElementById('mymodal');
var modalImg = document.getElementById("imgmodal");
var closebtn = modal.querySelector(".closebtn");
var images = document.querySelectorAll(".modalimg");
var idc = document.getElementById('idc');
var valimg = document.getElementById('valimg');

closebtn.addEventListener('click', closemodal);
window.onclick = function(event) {
    if (event.target == modal)
        modal.style.display = "none";
}
    for (i = 0; i < images.length; i++) 
        images[i].addEventListener("click", openmodal);
    function openmodal()
    {
        modal.style.display = 'block';
        modalImg.src = this.src;
        modalImg.alt = this.alt;
		valimg.value = this.alt;
    }
    function closemodal()
    {
        modal.style.display = 'none';
    }
</script>















