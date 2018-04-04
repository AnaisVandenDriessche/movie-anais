<?php
session_start();
include('inc/pdo.php');
include('inc/function.php');


include('inc/header.php'); 
?>
<a href="index.php">Retour vers page accueil</a>

 
<?php
if(!empty($_GET['slug']))  {

    //protection XSS
    $slug = trim(strip_tags($_GET['slug']));

    //REQUETE SQL
    $sql = "SELECT * FROM movies_full WHERE slug = :slug";
    
    $query = $pdo->prepare($sql);
    $query->bindValue(':slug',$slug, PDO::PARAM_STR);
    // exécuter la requete
    $query ->execute();
    // Puis sous quel format on la veut
    $movies = $query->fetchAll();
    $slug = $_GET['slug'];

    if(!empty($movies)){

    }else{
        die('404');
    }
        
}else{
    //fausse redirection
    die('404');
}


?>

<!-- boucle pour afficher le poster et le details de chaque film -->
<?php 
foreach  ($movies as $movie) { 
    if($movie['slug'] == $slug){ ?>
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

                <a href="details.php?slug=<?php echo $movie['id'];?>">
                <img src="posters/<?php echo $movie['id'] ?>.jpg" alt=""></a>
        
        
            </div>
    <?php }
} 
?>


<!-- - Bouton « à voir » -->

    <!-- <a href="film_a_voir.php"><input type="button" name="A voir" value="film à voir"/></a> -->
  
	


    <!-- //  - Bouton Retrait     -->

    <!-- <a href="film_a_voir.php"><input type="button" name="Retrait" value="film à retirer"/></a> -->

    

    <a  href="film_a_voir.php?id=<?php echo $movie['id']; ?>">film à ajouter</a>
    <a  href="film_a_voir.php?id=<?php echo $movie['id']; ?>">film à retirer</a>
