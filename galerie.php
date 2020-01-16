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
	$i = 0;
	while ($row = $req->fetch())
		{
			?>
			<div id="simplemodal<?php echo $i ?>" class="modall">
			<div class="modal-contentt">
				<span class="closebtn">&times;</span>
				<p>Hello modal <?php echo $i ?></p>
			</div>
		</div>
				<img width=30% src="<?php echo $row['img'] ?>" id="pics-post<?php echo $i ?>" class="pics-post">
		<?php
			$i += 1;
		}
	$req->closeCursor();

?>



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

<!-- <script src="js/script.js"> -->
<script>




// var modal = [];
// var modalbtn = [];
// var closebtn = [];
// for (i=0; i<9; i++) {

//     modal[i] = document.getElementById('simplemodal'+i);

//     modalbtn[i] = document.getElementById('pics-post'+i);
//     modalbtn[i].addEventListener('click', () => {
//         modal[i].style.display = 'block';
//     });
//     window.addEventListener('click', eval('clickoutside'+i));

//     closebtn[i] = document.getElementsByClassName('closebtn')[i];
//     closebtn[i].addEventListener('click', () => {
//         modal[i].style.display = 'none';
//     });
// }









var modal = [];
for (i=0; i<9; i++)
{
	modal[i] = document.getElementById('simplemodal'+i);
}

var modalbtn = [];
for (i=0; i<9; i++) {
	modalbtn[i] = document.getElementById('pics-post'+i);
	modalbtn[i].addEventListener('click', eval('openmodal'+i));
	window.addEventListener('click', eval('clickoutside'+i));
}

for (i=0; i<9; i++) {
	modalbtn[i] = document.getElementById('pics-post'+i);
	modalbtn[i].addEventListener('click', eval('openmodal'+i));
	window.addEventListener('click', eval('clickoutside'+i));
}


var closebtn0 = document.getElementsByClassName('closebtn')[0];
var closebtn1 = document.getElementsByClassName('closebtn')[1];
var closebtn2 = document.getElementsByClassName('closebtn')[2];
var closebtn3 = document.getElementsByClassName('closebtn')[3];
var closebtn4 = document.getElementsByClassName('closebtn')[4];
var closebtn5 = document.getElementsByClassName('closebtn')[5];
var closebtn6 = document.getElementsByClassName('closebtn')[6];
var closebtn7 = document.getElementsByClassName('closebtn')[7];
var closebtn8 = document.getElementsByClassName('closebtn')[8];


for (i=0; i<9; i++) {
	eval('closebtn'+i.addEventListener('click', eval('closemodal'+i)));
}



function openmodal0(){
	modal[0].style.display = 'block';
}
function openmodal1(){
	modal[1].style.display = 'block';
}
function openmodal2(){
	modal[2].style.display = 'block';
}
function openmodal3(){
	modal[3].style.display = 'block';
}
function openmodal4(){
	modal[4].style.display = 'block';
}
function openmodal5(){
	modal[5].style.display = 'block';
}
function openmodal6(){
	modal[6].style.display = 'block';
}
function openmodal7(){
	modal[7].style.display = 'block';
}
function openmodal8(){
	modal[8].style.display = 'block';
}




function closemodal0(){
	modal[0].style.display = 'none';
}
function closemodal1(){
	modal[1].style.display = 'none';
}
function closemodal2(){
	modal[2].style.display = 'none';
}
function closemodal3(){
	modal[3].style.display = 'none';
}
function closemodal4(){
	modal[4].style.display = 'none';
}
function closemodal5(){
	modal[5].style.display = 'none';
}
function closemodal6(){
	modal[6].style.display = 'none';
}
function closemodal7(){
	modal[7].style.display = 'none';
}
function closemodal8(){
	modal[8].style.display = 'none';
}



function clickoutside0(e){
	if(e.target == modal[0])
		modal[0].style.display = 'none';
}
function clickoutside1(e){
	if(e.target == modal[1])
		modal[1].style.display = 'none';
}
function clickoutside2(e){
	if(e.target == modal[2])
		modal[2].style.display = 'none';
}
function clickoutside3(e){
	if(e.target == modal[3])
		modal[3].style.display = 'none';
}
function clickoutside4(e){
	if(e.target == modal[4])
		modal[4].style.display = 'none';
}
function clickoutside5(e){
	if(e.target == modal[5])
		modal[5].style.display = 'none';
}
function clickoutside6(e){
	if(e.target == modal[6])
		modal[6].style.display = 'none';
}
function clickoutside7(e){
	if(e.target == modal[7])
		modal[7].style.display = 'none';
}
function clickoutside8(e){
	if(e.target == modal[8])
		modal[8].style.display = 'none';
}

</script>












