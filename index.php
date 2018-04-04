<?php 
include('inc/pdo.php');
include('inc/function.php'); 

	// Requette 
	$sql = "SELECT * FROM movies_full ORDER BY RAND()";
	$query = $pdo->prepare($sql);
	// exécuté la requete
	$query ->execute();
	// Puis sous quel format on la veut
	$movies = $query->fetchAll();


// Header
include('inc/header.php'); 
?>

 	<!-- Boucle pour afficher films -->
	<div class="container">
		<div class="row">
				<?php foreach ($movies as $movie) { ?>
					<div class="col-3">
						<a href="details.php?id=<?php echo $movie['id']; ?>">
							<img src="posters/<?php echo $movie['id'] ?>.jpg" alt="<?php echo $movie['title'] ?>">
						</a>
						<p class="title"> <?php echo $movie ['title'];?> </p>
					</div>
					<!-- end div col-3 -->
				<?php }?>
		</div>
		<!-- end div row -->
		<!-- Lien Recharge film -->
		<a href="index.php">+ de films</a>
		<a href="#">Filtre</a>
		
	</div>
	<!-- end div container -->
	

<!-- Footer -->
<?php include('inc/footer.php') ?>
