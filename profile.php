<?php
require "header.php";
require "./config/database_connect.php";
$id = $_SESSION['id'];

$imgParPage = 9;
$req = $bdd->prepare("SELECT id_img FROM pictures WHERE id_user= :id");
$req->execute(array('id' => $id));
$imgtot = $req->rowCount();
$pagestot = ceil($imgtot / $imgParPage);

if (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] <= $pagestot){
	$_GET['page'] = intval($_GET['page']);
	$pagecourante = $_GET['page'];
}
else{
	$pagecourante = 1;
}
$depart = ($pagecourante - 1) * $imgParPage;

$req = $bdd->prepare("SELECT img_nbr FROM users WHERE idUsers = :id");
$req->execute(array('id' => $id));
if ($row = $req->fetch())
{
    $img_nbr = $row['img_nbr'];
}
?>

<div class="container profil">
   

        <table class="table table-bordered">
        <tbody>
            <tr>
            <td class="text-right" rowspan="2">
                <img src="<?php echo $_SESSION['img_p']; ?>" class="img-profil">
            </td>
            <td>
                <h1><?php echo $_SESSION['nameUsers']; ?></h1>
            </td>
            <td>
                <button class="btn btn-primary modifp" onclick="window.location.href = 'edit_profile.php';">Modifier le profil</button>
            </td>
            </tr>
            <tr>
            <td><?php echo $img_nbr ?> Publications</td>
            <td></td>
            </tr>
        </tbody>
        </table>

 
    <hr>



    <?php
        $req = $bdd->prepare("SELECT * FROM pictures WHERE id_user= :id ORDER BY `date` DESC LIMIT ".$depart.",".$imgParPage);
        $req->execute(array('id' => $id));
        
        while ($row = $req->fetch())
        {
            echo '<img width=30% src='.$row['img'].' class="pics-profile">';
        }
        $req->closeCursor();
	?>


<nav aria-label="Page navigation" class="center">
  <ul class="pagination justify-content-center ">
	<?php 
		if ($pagecourante == 1)
			echo '<li class="page-item disabled"><a class="page-link"><<</a></li>';
		else
			echo '<li class="page-item"><a class="page-link" href="profile.php?page='.($pagecourante - 1).'"><<</a></li>';
		for($i=1; $i<=$pagestot;$i++){
			if($i == $pagecourante)
				echo '<li class="page-item active"><a class="page-link">'.$i.'</a></li>';
			else
				echo '<li class="page-item"><a class="page-link" href="profile.php?page='.$i.'">'.$i.'</a></li>';
		}
		if ($pagecourante == $pagestot)
			echo '<li class="page-item disabled"><a class="page-link">>></a></li>';
		else
			echo '<li class="page-item"><a class="page-link" href="profile.php?page='.($pagecourante + 1).'">>></a></li>';
	?>
  </ul>
</nav>



</div>
