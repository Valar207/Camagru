<?php
require "header.php";
require "./config/database_connect.php";
$id = $_SESSION['id'];

$imgParPage = 9;
$req = $bdd->prepare("SELECT id_img FROM pictures WHERE id_user= :id");
$req->execute(array('id' => $id));
$imgtot = $req->rowCount();
$pagestot = ceil($imgtot / $imgParPage);

if ($pagestot == 0)
	$pagestot = 1;

if (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] <= $pagestot){
	$_GET['page'] = intval($_GET['page']);
	$pagecourante = $_GET['page'];
}
else{
	$pagecourante = 1;
}
$depart = ($pagecourante - 1) * $imgParPage;

/*count number of img for current user*/
$req = $bdd->prepare("SELECT img_nbr FROM users WHERE idUsers = :id");
$req->execute(array('id' => $id));
if ($row = $req->fetch())
    $img_nbr = $row['img_nbr'];

/*count number of likes for current user*/
$req = $bdd->prepare("SELECT * FROM likes INNER JOIN pictures ON likes.id_img=pictures.id_img WHERE pictures.id_user = :id");
$req->execute(array('id' => $id));
$likes = $req->rowCount();

/*count number of comments for current user*/
$req = $bdd->prepare("SELECT * FROM comments INNER JOIN pictures ON comments.id_img=pictures.id_img WHERE pictures.id_user = :id");
$req->execute(array('id' => $id));
$comments = $req->rowCount();

    if (isset($_SESSION['nameUsers']))
    {
?>
<div class="container profil">

        <table class="table">
        <tbody>
            <tr class="text-center">
                <td class="text-right">
                    <img src="<?php echo $_SESSION['img_p']; ?>" class="img-profil">
                </td>
                <td>
                    <h1><?php echo $_SESSION['nameUsers']; ?></h1>
                </td>
                <td >
                    <button class="btn btn-primary modifp" onclick="window.location.href = 'edit_profile.php';">Modifier le profil</button>
                </td>
            </tr>
            <tr class="text-center">
                <td><?php echo $img_nbr; ?> <br> Publications</td>
                <td><?php echo $likes; ?> <br> Likes</td>
                <td><?php echo $comments; ?> <br> Commentaires</td>
            </tr>
        </tbody>
        </table>
        <hr>
        <?php

        if (isset($_GET['picture'])){
            if ($_GET['picture'] == 'deleted'){
                echo '<div class="col-sm-8 offset-sm-2 text-center alert alert-success" role="alert">
                    Photo supprimée.
                    </div>';
            }
        }
        ?>
            
    <form action="includes/profile_delpics.inc.php" method="post">
    <div class="form-row">

    <?php
        $req = $bdd->prepare("SELECT * FROM pictures WHERE id_user= :id ORDER BY `date` DESC LIMIT ".$depart.",".$imgParPage);
        $req->execute(array('id' => $id));
        while ($row = $req->fetch())
        {
            $likes = $row['like'];
			$coms = $row['comment'];
            ?>
            <div class="col-4 text-center" style="padding: 0.5% 1% 0.5% 1%;">
			<a href="photo.php?id_img=<?php echo $row['id_img'] ?>&page=<?php echo $pagecourante ?>&profil=yes">
                            <img width=100% src='<?php echo $row['img'] ?>' class="modalimg-profil">
							<h5 class="centeredd"><img src="icones/heart.svg" width=25> <?php echo $likes ?> <img src="icones/comment.svg" width=25> <?php echo $coms ?></h5>
            </a>

                <br>
                <input type="hidden" name="pagecourante" value='<?php echo $pagecourante ?>'>
                <input type="hidden" name="id_img" value="<?php echo $row['id_img'] ?>">
                <button type="submit" class="btn btn-danger delpicbtn" name="delimg" value="<?php echo $row['img'] ?>">Supprimer</button>
            </div>
        <?php }
    ?>
    </div>
    </form>


<!-- Pagination -->
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
		{
			echo '<li class="page-item"><a class="page-link" href="profile.php?page='.($pagecourante + 1).'">>></a></li>';
		}
	?>
  </ul>
</nav>

</div>


<?php }
else{
    header("Location: index.php");
}
?>

<footer class="whitefooter text-center margin">
	Camagru 2020 @vrossi
</footer>