<?php include('inc/pdo.php');?>
<?php include('inc/function.php');  ?>

<?php include('inc/header.php'); ?>

<?php
$sql = "SELECT * FROM movies_full WHERE `id` = ROUND( RAND() * 9 ) + 1 ";
$query = $pdo->prepare($sql);
// exécuté la requete
$query ->execute();
// Puis sous quel format on la veut
$villes = $query->fetchAll();

?>

// Boucle
<div id="movies">
	<?php foreach ($movies as $movie) { ?>
	<div class="movie">
		<p class="title"> <?php echo $movie ['title'];?> </p>
		<a href="detail.php?id=<?php echo $movie['id']; ?>">
			<?php echo getImageMovie($movie['id'],$movie['title']);?>
		</a>
	</div>
<?php } ?>
</div>
<?php include('inc/footer.php') ?>
