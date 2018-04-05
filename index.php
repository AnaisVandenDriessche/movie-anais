<?php

include('inc/function.php');
session_start();
// connection a la BDD
include('inc/pdo.php');
$error  = array();
$sucess = false;
// formulaire soumis
if (!empty($_GET['submitted'])) {
	$sql = "SELECT * FROM movies_full WHERE 1 = 1";

		// ANNEE
			$year1       = trim(strip_tags($_GET['year1']));
			$year2       = trim(strip_tags($_GET['year2']));
				if(!empty($year1) && !empty($year2)) {
					if($year1 < $year2) {
							$sql .= " AND year BETWEEN $year1 AND $year2";
						}
					}


		//popularity
			$popularity1 	= trim(strip_tags($_GET['popularity1']));
			$popularity2 	= trim(strip_tags($_GET['popularity2']));
				if (!empty($popularity1) &&  !empty($popularity2)) {
						if ($popularity1 < $popularity2) {
							  $sql .=  " AND popularity BETWEEN $popularity1 AND $popularity2";
						}
				}


						// debug($movies);

		//Genres
			 $genres = $_GET['genres'] ;
			 //print_r($genres);
			 //die();
			 $i = 0;
			 foreach ($genres as $genre) {
				 if($i == 0) {
					 $sql .=  " AND genres LIKE '%$genre%'";
				 } else {
					 $sql .=  " OR genres LIKE '%$genre%'";
				 }
				 $i++;

			 }

			 // final request
					 $sql .= ' ORDER BY RAND() LIMIT 5';


					// $sql .=  'LIMIT 10';
					$query = $pdo ->prepare($sql);
					$query->execute();
					$movies = $query->fetchAll();
					 debug($movies);
}
debug($error);
?>


<?php




// Requete
$sql = 'SELECT * FROM movies_full ORDER BY RAND()';
$query = $pdo ->prepare($sql);
// Executer la requete
$query -> execute ();
// Puis sous quel format
$movies = $query->fetchAll();
 // Header
include('inc/header.php');
 // header('Location: detail.php?id=' . $id );
?>

<div class="container">

	<form method="get" action="">

		<div class="form-check">
  		<input class="form-check-input" name="genres[]" type="checkbox" value="Fantasy">
    		<label class="form-check-label" for="defaultCheck1">   Fantasy </label>
  	</div>

		<div class="form-check">
  		<input class="form-check-input" name="genres[]" type="checkbox" value="Drama">
  			<label class="form-check-label" for="defaultCheck2">   Drama </label>
		</div>

		<div class="form-check">
  		<input class="form-check-input" name="genres[]" type="checkbox" value="Adventure">
  			<label class="form-check-label" for="defaultCheck3"> Adventure	</label>
		</div>


		<div class="form-check">
			<input class="form-check-input" name="genres[]" type="checkbox" value="Comedy">
				<label for="form-check-label" for="defaultCheck3" > Comedy </label>
		</div>

		<div class="form-check">
			<input class="form-check-input" name="genres[]" type="checkbox" value="Crime">
				<label for="form-check-label">	Thriller </label>
		</div>

		<div class="form-check">
			<input class="form-check-input" name="genres[]" type="checkbox" value="Romance">
				<label for="form-check-label">	Romance </label>
		</div>

		<div class="form-check">
			<input class="form-check-input" name="genres[]" type="checkbox" value="Mystery">
				<label for="form-check-label"> Mystery </label>
		</div>

		<div class="form-check">
			<input class="form-check-input" name="genres[]" type="checkbox" value="Sci-Fi">
				<label for="form-check-label"> Science-Fiction </label>
		</div>

		<div class="form-check">
			<input class="form-check-input" name="genres[]" type="checkbox" value="Horror">
				<label for="form-check-label"> Horreur </label>
		</div>

<!-- Select Année de procduction  -->

		<h2> Année de production entre </h2>
				<label for="year">  </label>
				<select class="year" name="year1">
						<?php for ($i=date('Y'); $i>=1900 ;  $i--) {
								echo "<option>$i</option>";
									}
	 					?>
				</select>

				<label for="year"> </label>
				<select class="year" name="year2">
						<?php for ($i=date('Y'); $i>=1900 ;  $i--) {
								echo "<option>$i</option>";
									}
	 					?>
		  	</select>

<!-- Select Niveau de Popularité  -->


		<h2> La popularité  </h2>
			<label for="popularity">  </label>
			<select class="popularity2" name="popularity1">
					<?php for ($i= 1; $i<100 ;  $i++) {
							echo "<option>$i</option>";
								}
	 				?>
			 </select>


		<label for="popularity">  </label>
		<select class="popularity2" name="popularity2">
				<?php for ($i= 1 ; $i<100 ;  $i++) {
						echo "<option>$i</option>";
					    }
	 			?>
		</select>

    <input type="submit" class="btn btn-primary" name="submitted" value="Rechercher" />

	</form>
</div>

     <!-- Boucle pour afficher films -->
    <div class="container">
    	<div class="row">
        <?php foreach ($movies as $movie) { ?>
         	<div class="col-3">
          	<a href="details.php?slug=<?php echo $movie['slug'];?>">
            	<img src="posters/<?php echo $movie['id']; ?>.jpg" alt="<?php echo $movie['title'];?>">
              	</a>
                	<p class="title"> <?php
    									echo $movie['title'];?> </p>
          </div>
                    <!-- end div col-3 -->
      <?php
			}?>
    	</div>
        <!-- end div row -->
        <!-- Lien Recharge film -->
        <a href="index.php">+ de films</a>
        <a href="#">Filtre</a>

	</div>
	<!-- end div container -->


<!-- Footer -->
<?php include('inc/footer.php') ?>