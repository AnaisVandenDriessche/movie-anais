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
   $id = $_GET['id'];
    
}else{
    //fausse redirection
    // die('404');
}
?>
<!-- boucle pour afficher le poster et le details de chaque film -->
<?php 
foreach  ($movies as $movie) { 
    if($movie['id'] == $id){ ?>
            <div class="movie">
        <p class='title'><?php echo $movie['title']; ?></p>
        <p class='slug'><?php echo $movie['title']; ?></p>
        <p class='year'><?php echo $movie['year']; ?></p>
        <p class='genres'><?php echo $movie['genres']; ?></p>
        <p class='plot'><?php echo $movie['plot']; ?></p>
        <p class='directors'><?php echo $movie['directors']; ?></p>
        <p class='cast'><?php echo $movie['cast']; ?></p>
        <p class='writers'><?php echo $movie['writers']; ?></p>
        <p class='runtime'><?php echo $movie['runtime']; ?></p>
        <p class='mpaa'><?php echo $movie['mpaa']; ?></p>
        <p class='rating'><?php echo $movie['rating']; ?></p>
        <p class='popularity'><?php echo $movie['popularity']; ?></p>
        <p class='modified'><?php echo $movie['modified']; ?></p>
        <p class='created'><?php echo $movie['created']; ?></p>
        <p class='poster_flag'><?php echo $movie['poster_flag']; ?></p>

        <a href="details.php?id=<?php echo $movie['id'];?>">
        <?php echo getImageMovie($movie['id'],$movie['title']); ?>
        
</div>
    <?php }
    ?>
    
<?php } ?>




