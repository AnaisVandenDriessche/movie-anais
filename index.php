<?php include('inc/pdo.php');?>
<?php include('inc/function.php');  ?>



<?php
$sql = "SELECT * FROM movies_full WHERE RAND() "  ;
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
<?php include('inc/header.php'); ?>


<!-- <form class="" action="index.html" method="post">

</form> -->

	<?php foreach ($movies as $movie) { ?>
		<div class="container">

				<div class="col-6">
					<a href="details.php?id=<?php echo $movie['id']; ?>"><img src="posters/<?php echo $movie['id'] ?>.jpg" alt=""></a>
					<p class="title"> <?php echo $movie ['title'];?> </p>
				</div>
		
		</div>
	<?php }
	?>
	<!-- Bouton + de film  -->
	<a href="index.php"> + de films !  </a>
<?php include('inc/footer.php') ?>
