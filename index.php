<?php
session_start();
include('inc/function.php');
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
			// debug($movies);
}
// debug($error);
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
	<!-- Formulaire -->
	<form method="get" action="" >
		<div class="form-row">
			<!-- Fantasy -->
			<div class="form-check form-check-inline">
				<input class="form-check-input" name="genres[]" type="checkbox" value="Fantasy">
				<label class="form-check-label" for="genres[]">Fantasy</label>
			</div>
			<!-- Drama -->
			<div class="form-check form-check-inline">
				<input class="form-check-input" name="genres[]" type="checkbox" value="Drama">
				<label class="form-check-label" for="genres[]">Drama</label>
			</div>
			<!-- Adventure -->
			<div class="form-check form-check-inline">
				<input class="form-check-input" name="genres[]" type="checkbox" value="Adventure">
				<label class="form-check-label" for="defaultCheck3">Adventure</label>
			</div>
			<!-- Comedy -->
			<div class="form-check form-check-inline">
				<input class="form-check-input" name="genres[]" type="checkbox" value="Comedy">
				<label class="form-check-label" for="form-check-label" for="genres[]">Comedy</label>
			</div>
			<!-- Thriller -->
			<div class="form-check form-check-inline">
				<input class="form-check-input" name="genres[]" type="checkbox" value="Crime">
				<label class="form-check-label" for="genres[]">Thriller</label>
			</div>
			<!-- Romance -->
			<div class="form-check form-check-inline">
				<input class="form-check-input" name="genres[]" type="checkbox" value="Romance">
				<label class="form-check-label" for="genres[]">Romance</label>
			</div>
			<!-- Mystery -->
			<div class="form-check form-check-inline">
				<input class="form-check-input" name="genres[]" type="checkbox" value="Mystery">
				<label class="form-check-label" for="form-check-label">Mystery</label>
			</div>
			<!-- S-F -->
			<div class="form-check form-check-inline">
				<input class="form-check-input" name="genres[]" type="checkbox" value="Sci-Fi">
				<label class="form-check-label" for="form-check-label">Science-Fiction</label>
			</div>

			<div class="form-check form-check-inline">
				<input class="form-check-input" name="genres[]" type="checkbox" value="Horror">
				<label class="form-check-label" for="form-check-label">Horreur</label>
			</div>
		</div>
		<div class="form-row mb-3 mt-3 ">
			<!-- Select Année de procduction  -->
			<div class="col">
				<!-- <p class="font-weight-bold">Choisir année de production</p> -->
				<label class="font-weight-bold" for="year1">Année de production de :</label>
				<select class="form-control" name="year1">
					<option value="">---</option>
					<?php for ($i=date('Y'); $i>=1900 ;  $i--) {
						echo "<option>$i</option>";
					}
					?>
				</select>
			</div>
			<div class="col">
				<label class="font-weight-bold" for="year2">A :</label>
				<select class="form-control" name="year2">
					<option value="">---</option>			
					<?php for ($i=date('Y'); $i>=1900 ;  $i--) {
						echo "<option>$i</option>";
						}
					?>
				</select>
			</div>
			<div class="col">
			<!-- Select Niveau de Popularité  -->
				<!-- <p class="font-weight-bold">La popularité</p>		 -->
				<label class="font-weight-bold" for="popularity1">Popularité de :</label>
				<select class="form-control" name="popularity1">
					<option value="">---</option>				
					<?php for ($i= 1; $i<100 ;  $i++) {
						echo "<option>$i</option>";
						}
					?>
				</select>
			</div>
			<div class="col">
				<label class="font-weight-bold" for="popularity2">A :</label>
				<select class="form-control" name="popularity2">
					<option value="">---</option>				
					<?php for ($i= 1 ; $i<100 ;  $i++) {
						echo "<option>$i</option>";
						}
					?>
				</select>
			</div>	
		</div>

			<!-- Submit -->
			<input type="submit" class="btn btn-warning mt-3 text-center" name="submitted" value="Rechercher" />	
		</div>
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