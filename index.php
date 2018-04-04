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


	<?php foreach ($movies as $movie) { ?>

	<div class="container">
		<div class="row">
			<div class="col-4">
				
				<a href="details.php?id=<?php echo $movie['id']; ?>"><img src="posters/<?php echo $movie['id'] ?>.jpg" alt=""></a>
				<p class="title"> <?php echo $movie ['title'];?> </p>
			</div>
		</div>
	</div>
	<?php }
	?>


<?php include('inc/footer.php') ?>
