<!-- /////////////////  -  La page de détail
//Outre l’affiche du film et son titre, toutes les données présentes en base de données sont affichées.

///////////////////////////  PAGE DE DETAILS
// Outre l’affichage du poster et de tous les détails du film, les éléments suivants doivent être présents :
	// - Pretty Url
		// - L’url de ces pages de détails devrait contenir la version normalisée du titre du film (slug). Et tant qu’à y être, 
        faites tout votre possible pour référencer au mieux cette page par rapport au titre du film et de son année de réalisation. -->

<?php
include('inc/pdo.php');
include('inc/function.php');



include('inc/header.php'); 


if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
$sql = "SELECT * FROM movies_full";
$query = $pdo->prepare($sql);
// exécuté la requete
$query ->execute();
// Puis sous quel format on la veut
$movies = $query->fetchAll();
$id = $_GET['id'];
    
}else{
    //fausse redirection
    die('404');
}
?>

<!-- boucle pour afficher le poster et le details de chaque film -->
<?php 
foreach  ($movies as $movie) { 
    if($movie['id'] == $id){ ?>
            <div class="container">
                <p class='title'>Titre du film: <?php echo $movie['title']; ?></p>
                <p class='slug'>Slug: <?php echo $movie['slug']; ?></p>
                <p class='year'>Année: <?php echo $movie['year']; ?></p>
                <p class='genres'>Genres: <?php echo $movie['genres']; ?></p>
                <p class='plot'>Pitch: <?php echo $movie['plot']; ?></p>
                <p class='directors'>Réalisateur: <?php echo $movie['directors']; ?></p>
                <p class='cast'>Casting: <?php echo $movie['cast']; ?></p>
                <p class='writers'>Scénaristes: <?php echo $movie['writers']; ?></p>
                <p class='runtime'>Durée du film: <?php echo $movie['runtime']; ?></p>
                <p class='mpaa'>Motion Picture Association of America: <?php echo $movie['mpaa']; ?></p>
                <p class='rating'>Note: <?php echo $movie['rating']; ?></p>
                <p class='popularity'>Popularité: <?php echo $movie['popularity']; ?></p>
                <p class='modified'>modifié le: <?php echo $movie['modified']; ?></p>
                <p class='created'>créé le: <?php echo $movie['created']; ?></p>
                <p class='poster_flag'>Affiche du film: <?php echo $movie['poster_flag']; ?></p>

                <a href="details.php?id=<?php echo $movie['id'];?>">
                <img src="posters/<?php echo $movie['id'] ?>.jpg" alt=""></a>
        
        
            </div>
    <?php }
} ?>




