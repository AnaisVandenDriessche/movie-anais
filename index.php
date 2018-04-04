<?php include('inc/pdo.php');?>
<?php include('inc/function.php');  ?>

<?php include('inc/header.php'); ?>

<?php
$sql = "SELECT * FROM movies_full";
$query = $pdo->prepare($sql);
// exécuté la requete
$query ->execute();
// Puis sous quel format on la veut
$movies = $query->fetchAll();

?> 

<!-- <?php
// echo '<pre>';
// print_r($movies);
// echo '</pre>';
 ?> -->

<div id="movies">
	<?php foreach ($movies as $movie) { ?>
	<div class="movie">
		<p class="title"> <?php echo $movie ['title'];?> </p>
		<a href="details.php?id=<?php echo $movie['id']; ?>">
		<?php $img ='<src="posters' .$id.'.jpg" alt="'.$title.'" />';
		return $img;
	}
	?>
		
		</a>
	</div>

</div>
<?php include('inc/footer.php') ?>
